<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function IMTable()
    {
        Session::put('route', 'imp.table');
        $documents = Document::with('creator', 'personIncharge')
            ->where('status', '=', 'MD accepted')
            ->orderBy('date_created', 'desc')
            ->get();
        return view('implement.table', compact('documents'));
    }

    public function reviewDoc(Document $document)
    {
        $document->load('creator', 'personIncharge', 'HOD', 'QC', 'MD', 'user');
        $users = User::select('id', 'job_title')->get();
        return view('implement.view-document', compact('document', 'users'));
    }

    public function update(Document $document, Request $request)
    {

        $request->validate([
            "user_id.*"  => "required",
            "implementation_date" => "required",
        ]);

        $document->update([
            'implementor_date' => now()->format('Y-m-d'), 'implementor_comment' => $request->implementor_comment,
            'implementor' => auth()->id(), 'implementation_date' => $request->implementation_date, 'status' => 'Implemented'
        ]);

        foreach ($request->user_id as $key => $user_id) {
            Role::create([
                'user_id' => $user_id, 'doc_id' => $document->id
            ]);
        }

        Toastr::success('Upload Successful', 'Title', ["positionClass" => "toast-bottom-right"]);

        if ($request->link == 'yes') {
            return redirect()->route('document.link')->with(['doc' => $document]);
        } else {
            return redirect()->route(Session::get('route'));
        }
    }

}