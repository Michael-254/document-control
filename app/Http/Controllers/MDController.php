<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
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
        $document->load('creator', 'personIncharge', 'HOD', 'QC', 'user');
        return view('MD.view-document', compact('document'));
    }

    public function update(Document $document, Request $request)
    {
        $data = $request->validate([
            'status' => 'required',
            'MD_comment' => 'nullable'
        ]);

        $document->update($data + ['MD_date' => now()->format('Y-m-d'), 'MD_approver' => auth()->id()]);

        if ($request->status == 'MD accepted') {
            $data = [
                'intro'  => 'Dear QC,',
                'content'   => 'New Document has been submitted for implementation, Doc No:' . $document->document_no,
                'name' => 'Quality Cordinator',
                'email' => 'lawrence@betterglobeforestry.com',
                'subject'  => 'New Document for Implementation'
            ];
            Mail::send('emails.email', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject($data['subject']);
            });
        } else {
            $data = [
                'intro'  => 'Dear ' . $document->user->job_title . ',',
                'content'   => 'Your Document bearing document no:' . $document->document_no . 'Was rejected for reasons:' . $request->MD_comment,
                'name' => $document->user->job_title,
                'email' => $document->user->email,
                'subject'  => 'Rejected Document on MD Review'
            ];
            Mail::send('emails.email', $data, function ($message) use ($data, $document) {
                $message->to($data['email'], $data['name'])
                    ->cc($document->HOD->email, $document->QC->email)
                    ->subject($data['subject']);
            });
        }

        Toastr::success('Decision updated successfully', 'Title', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route(Session::get('route'));
    }
}
