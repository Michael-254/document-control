<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
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
        $document->load('creator', 'personIncharge', 'HOD', 'user');
        return view('QC.view-document', compact('document'));
    }

    public function update(Document $document, Request $request)
    {
        $data = $request->validate([
            'status' => 'required',
            'QC_comment' => 'nullable'
        ]);

        $document->update($data + ['QC_date' => now()->format('Y-m-d'), 'QC_revisor' => auth()->id()]);

        if ($request->status == 'QC accepted') {
            $data = [
                'intro'  => 'Dear MD,',
                'content'   => 'New Document has been submitted for your approval, Doc No:' . $document->document_no,
                'name' => 'Managing Director',
                'email' => 'jpd@betterglobeforestry.com',
                'subject'  => 'New Document for review'
            ];
            Mail::send('emails.email', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject($data['subject']);
            });
        } else {
            $data = [
                'intro'  => 'Dear ' . $document->user->job_title . ',',
                'content'   => 'Your Document bearing document no:' . $document->document_no . 'Was rejected for reasons:' . $request->QC_comment,
                'name' => $document->user->job_title,
                'email' => $document->user->email,
                'subject'  => 'Rejected Document on QC Review'
            ];
            Mail::send('emails.email', $data, function ($message) use ($data, $document) {
                $message->to($data['email'], $data['name'])
                    ->cc($document->HOD->email)
                    ->subject($data['subject']);
            });
        }

        Toastr::success('Decision updated successfully', 'Title', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route(Session::get('route'));
    }
}
