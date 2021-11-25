<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class DocumentController extends Controller
{
    public function create()
    {
        $users = User::select('id', 'job_title')->get();
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
            'file' => $Fname, 'document_no' => $Code, 'date_created' => now()->format('d/m/Y')
        ]);
        $doc->update(['document_no' => 'BGF-' . $doc->depart() . '-' . $doc->document_no . '-00' . $doc->id]);
        Toastr::success('Upload Successful', 'Title', ["positionClass" => "toast-bottom-right"]);

        return redirect('dashboard');
    }
}
