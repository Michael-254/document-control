<?php

namespace App\Http\Controllers;

use App\Models\Confirm;
use App\Models\Document;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;

class DocumentController extends Controller
{
    public function myAccess()
    {
        $roles = Role::whereUserId(auth()->id())->pluck('doc_id')->toArray();
        $documents = Document::with('user', 'creator', 'personIncharge', 'HOD', 'QC', 'MD', 'Imp', 'links', 'access')
            ->whereKey($roles)
            ->paginate(10);
        return view('upload.accessible-docs', compact('documents'));
    }

    public function dashboard()
    {
        $documents = Document::whereUserId(auth()->id())->get();
        return view('upload.table', compact('documents'));
    }

    public function viewDocument(Document $document)
    {
        $document->load('creator', 'personIncharge', 'HOD', 'QC', 'MD', 'Imp');
        return view('upload.document', compact('document'));
    }

    public function create()
    {
        $users = User::select('id', 'job_title')->orderBy('job_title', 'asc')->get();
        return view('upload.upload', compact('users'));
    }

    private function getCode($names)
    {
        $name_array = explode(' ', trim($names));
        $firstWord = $name_array[0];
        $lastWord = $name_array[count($name_array) - 1];
        $initials = $firstWord[0] . "" . $lastWord[0];

        return $initials;
    }

    public function tempUpload(Request $request)
    {
        if ($request->hasfile('file')) {
            $filename = $request->file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $path = $request->file->storeAs('public/temp/' . $folder, $filename);
            Session::put('location', $folder);
            Session::put('Fname', $filename);
        }
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'revision_status' => 'required',
            'person_incharge' => 'required',
            'document_creator' => 'required',
            'department' => 'required',
            'location' => 'required',
            'uploader_comment' => 'nullable',
        ]);

        $names = $request->title;
        $Code = $this->getCode($names);
        $file = Session::get('location');
        $Fname = Session::get('Fname');
        Storage::move(
            'public/temp/' . $file . '/' . $Fname,
            'public/documents/' . $request->department . '/' . $request->title . '/' . $Fname
        );
        Storage::deleteDirectory('public/temp/' . $file);

        $doc = Document::create($validateData + [
            'file' => $Fname, 'user_id' => auth()->id(),
            'document_no' => $Code, 'date_created' => now()->format('Y-m-d')
        ]);
        $doc->update(['document_no' => 'BGF-' . $doc->depart() . '-' . $doc->document_no . '-00' . $doc->id]);

        $data = [
            'intro'  => 'Dear HOD ' . $doc->department . ',',
            'content'   => 'New Document bearing document no: ' . $doc->document_no . 'has been submitted for your review. Logon to the system for action',
            'name' => 'HOD' . $doc->department,
            'email' => $doc->HODEmail(),
            'subject'  => 'New document for you review'
        ];
        Mail::send('emails.email', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])
                ->subject($data['subject']);
        });

        Toastr::success('Upload Successful', 'Title', ["positionClass" => "toast-bottom-right"]);

        return redirect('dashboard');
    }

    public function edit(Document $document)
    {
        $document->load('creator', 'personIncharge');
        $users = User::select('id', 'job_title')->get();
        return view('upload.edit-doc', compact('users', 'document'));
    }

    public function update(Request $request, Document $document)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'revision_status' => 'required',
            'person_incharge' => 'required',
            'document_creator' => 'required',
            'department' => 'required',
            'location' => 'required',
            'uploader_comment' => 'nullable',
        ]);

        $names = $request->title;
        $Code = $this->getCode($names);
        $file = Session::get('location');
        $Fname = Session::get('Fname');

        $path = storage_path('app/public/documents/' . $document->department . '/' . $document->title . '/' . $document->file);
        if ($path) {
            unlink($path);
        }
        Storage::move(
            'public/temp/' . $file . '/' . $Fname,
            'public/documents/' . $request->department . '/' . $request->title . '/' . $Fname
        );
        Storage::deleteDirectory('public/temp/' . $file);

        $document->update($validateData + [
            'file' => $Fname, 'user_id' => auth()->id(),
            'document_no' => $Code, 'date_created' => now()->format('Y-m-d'), 'status' => 'pending'
        ]);
        $document->update(['document_no'  => 'BGF-' . $document->depart() . '-' . $document->document_no . '-00' . $document->id]);

        $data = [
            'intro'  => 'Dear HOD' . $document->department . ',',
            'content'   => 'New Document bearing document no:' . $document->document_no . 'has been submitted for your review. Logon to the system for action',
            'name' => 'HOD' . $document->department,
            'email' => $document->HODEmail(),
            'subject'  => 'New document for you review'
        ];
        Mail::send('emails.email', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])
                ->subject($data['subject']);
        });

        Toastr::success('update Successful', 'Title', ["positionClass" => "toast-bottom-right"]);

        return redirect('dashboard');
    }

    public function confirmImp(Document $document)
    {
        $document->load('creator', 'personIncharge', 'HOD', 'QC', 'MD', 'user', 'Imp', 'confirms');
        return view('upload/confirmation-doc', compact('document'));
    }

    public function confirmUpdate(Document $document,  Request $request)
    {
        $data = $request->validate([
            'received' => 'required',
            'received_comment' => 'nullable',
            'read' => 'required',
            'read_comment' => 'nullable',
            'doc_implemented' => 'required',
            'doc_implemented_comment' => 'nullable',
            'destroyed' => 'required',
            'destroyed_comment' => 'nullable',
            'start_date' => 'nullable',
        ]);
        $confirm = Confirm::where('doc_id', $document->id)->first();
        if ($confirm) {
            $confirm->update($data);
        } else {
            $data['doc_id'] = $document->id;
            Confirm::create($data);
        }

        Toastr::success('Confirm Details Updated', 'Title', ["positionClass" => "toast-bottom-right"]);

        return redirect('Documents/I-can-access');
    }
}
