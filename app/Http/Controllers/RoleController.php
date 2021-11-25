<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Role;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class RoleController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            "user_id.*"  => "required",
        ]);

        $doc = Document::findorFail($request->doc_id);
        $doc->update(['document_no' => $request->document_no]);

        foreach ($request->user_id as $key => $user_id) {
            Role::create([
                'user_id' => $user_id, 'doc_id' => $request->doc_id
            ]);
        }

        Toastr::success('Upload Successful', 'Title', ["positionClass" => "toast-bottom-right"]);

        if ($request->link == 'yes') {
            return redirect()->route('document.link')->with(['doc' => $doc]);
        } else {
            return redirect()->route('dashboard');
        }
    }
}
