<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class MDController extends Controller
{
    public function MDTable()
    {
        Session::put('route', 'md.table');
        $documents = Document::with('creator', 'personIncharge')
            ->where('status', '=', 'QC accepted')
            ->orderBy('date_created', 'desc')
            ->get();
        return view('MD.table', compact('documents'));
    }

    public function reviewDoc(Document $document)
    {
        $document->load('creator', 'personIncharge','HOD','QC');
        return view('MD.view-document', compact('document'));
    }

    public function update(Document $document, Request $request)
    {
        $data = $request->validate([
            'status' => 'required',
            'MD_comment' => 'nullable'
        ]);

        $document->update($data + ['MD_date' => now()->format('d/m/Y'), 'MD_approver' => auth()->id()]);

        Toastr::success('Decision updated successfully', 'Title', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route(Session::get('route'));
    }
}
