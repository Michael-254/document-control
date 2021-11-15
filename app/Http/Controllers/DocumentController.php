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
            'date_created' => 'required',
            'revision_status' => 'required',
            'person_incharge' => 'required',
            'document_creator' => 'required',
            'revisor' => 'required',
            'approver' => 'required',
            'department' => 'required',
            'location' => 'required',
        ]);

        $file = Session::get('location');
        $Fname = Session::get('Fname');
        Storage::move(
            'public/temp/' . $file . '/' . $Fname,
            'public/documents/' . $request->department . '/' . $request->title . '/' . $Fname
        );
        Storage::deleteDirectory('public/temp/' . $file);

        $doc = Document::create($validateData + ['file' => $Fname]);
        Toastr::success('Upload Successful', 'Title', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('document.roles')->with(['doc' => $doc]);
    }

    public function roles()
    {
        $users = User::select('id', 'job_title')->get();
        return view('upload.roles', compact('users'));
    }
}
