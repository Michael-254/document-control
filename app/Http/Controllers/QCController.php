<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class QCController extends Controller
{
    public function QCTable()
    {
        Session::put('route', 'qc.table');
        $documents = Document::with('creator', 'personIncharge')
            ->where('status', '=', 'HOD accepted')
            ->OrWhere('status', '=', 'MD rejected')
            ->orderBy('date_created', 'desc')
            ->get();
        return view('QC.table', compact('documents'));
    }

    public function reviewDoc(Document $document)
    {
        $document->load('creator', 'personIncharge','HOD');
        return view('QC.view-document', compact('document'));
    }

    public function update(Document $document, Request $request)
    {
        $data = $request->validate([
            'status' => 'required',
            'QC_comment' => 'nullable'
        ]);

        $document->update($data + ['QC_date' => now()->format('d/m/Y'), 'QC_revisor' => auth()->id()]);

        Toastr::success('Decision updated successfully', 'Title', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route(Session::get('route'));
    }
}
