<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HODController extends Controller
{
    public function IT()
    {
        Session::put('route', 'it');
        $documents = Document::with('creator', 'personIncharge')
            ->where([['department', '=', 'IT'], ['status', '=', 'pending']])
            ->OrWhere([['department', '=', 'IT'], ['status', '=', 'QC rejected']])
            ->orderBy('date_created', 'desc')
            ->get();
        return view('hod.table', compact('documents'));
    }

    public function ME()
    {
        Session::put('route', 'me');
        $documents =  Document::with('creator', 'personIncharge')
            ->where([['department', '=', 'ME'], ['status', '=', 'pending']])
            ->OrWhere([['department', '=', 'ME'], ['status', '=', 'QC rejected']])
            ->orderBy('date_created', 'desc')
            ->get();
        return view('hod.table', compact('documents'));
    }

    public function Communications()
    {
        Session::put('route', 'Communications');
        $documents = Document::with('creator', 'personIncharge')
            ->where([['department', '=', 'Communications'], ['status', '=', 'pending']])
            ->OrWhere([['department', '=', 'Communications'], ['status', '=', 'QC rejected']])
            ->orderBy('date_created', 'desc')
            ->get();
        return view('hod.table', compact('documents'));
    }

    public function Accounts()
    {
        Session::put('route', 'Accounts');
        $documents = Document::with('creator', 'personIncharge')
            ->where([['department', '=', 'Accounts'], ['status', '=', 'pending']])
            ->OrWhere([['department', '=', 'Accounts'], ['status', '=', 'QC rejected']])
            ->orderBy('date_created', 'desc')
            ->get();
        return view('hod.table', compact('documents'));
    }

    public function Operations()
    {
        Session::put('route', 'Operations');
        $documents = Document::with('creator', 'personIncharge')
            ->where([['department', '=', 'Operations'], ['status', '=', 'pending']])
            ->OrWhere([['department', '=', 'Operations'], ['status', '=', 'QC rejected']])
            ->orderBy('date_created', 'desc')
            ->get();
        return view('hod.table', compact('documents'));
    }

    public function HR()
    {
        Session::put('route', 'HR');
        $documents = Document::with('creator', 'personIncharge')
            ->where([['department', '=', 'HR'], ['status', '=', 'pending']])
            ->OrWhere([['department', '=', 'HR'], ['status', '=', 'QC rejected']])
            ->orderBy('date_created', 'desc')
            ->get();
        return view('hod.table', compact('documents'));
    }

    public function Forestry()
    {
        Session::put('route', 'Forestry');
        $documents = Document::with('creator', 'personIncharge')
            ->where([['department', '=', 'Forestry'], ['status', '=', 'pending']])
            ->OrWhere([['department', '=', 'Forestry'], ['status', '=', 'QC rejected']])
            ->orderBy('date_created', 'desc')
            ->get();
        return view('hod.table', compact('documents'));
    }

    public function MITI()
    {
        Session::put('route', 'MITI');
        $documents = Document::with('creator', 'personIncharge')
            ->where([['department', '=', 'Miti Magazine'], ['status', '=', 'pending']])
            ->OrWhere([['department', '=', 'Miti Magazine'], ['status', '=', 'QC rejected']])
            ->orderBy('date_created', 'desc')
            ->get();
        return view('hod.table', compact('documents'));
    }

    public function SeniorManagement(){
        Session::put('route', 'SM');
        $documents = Document::with('creator', 'personIncharge')
            ->where([['department', '=', 'Management'], ['status', '=', 'pending']])
            ->OrWhere([['department', '=', 'Management'], ['status', '=', 'QC rejected']])
            ->orderBy('date_created', 'desc')
            ->get();
        return view('hod.table', compact('documents'));
    }

    public function reviewDoc(Document $document)
    {
        $document->load('creator', 'personIncharge', 'QC', 'MD', 'user');
        return view('hod.view-document', compact('document'));
    }

    public function update(Document $document, Request $request)
    {
        $data = $request->validate([
            'status' => 'required',
            'HOD_comment' => 'nullable'
        ]);

        $document->update($data + ['HOD_date' => now()->format('Y-m-d'), 'HOD_revisor' => auth()->id()]);

        if ($request->status == 'HOD accepted') {
            $data = [
                'intro'  => 'Dear Quality Cordinator,',
                'content'   => 'New Document has been submitted for your approval, Doc No:' . $document->document_no,
                'name' => 'Quality Coedinator',
                'email' => 'lawrence@betterglobeforestry.com',
                'subject'  => 'New Document for review'
            ];
            Mail::send('emails.email', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject($data['subject']);
            });
        } else {
            $data = [
                'intro'  => 'Dear ' . $document->user->job_title . ',',
                'content'   => 'Your Document bearing document no:' . $document->document_no . 'Was rejected for reasons:' . $request->HOD_comment,
                'name' => $document->user->job_title,
                'email' => $document->user->email,
                'subject'  => 'Rejected Document on HOD Review'
            ];
            Mail::send('emails.email', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject($data['subject']);
            });
        }

        Toastr::success('Decision updated successfully', 'Title', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('hod.' . Session::get('route'));
    }
}
