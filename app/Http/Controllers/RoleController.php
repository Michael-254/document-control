<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

        $time = time();

        if (!\File::exists(public_path('images/QRCodes'))) {
            \File::makeDirectory(public_path('images/QRCodes'), $mode = 0777, true, true);
        }

        $qr_code =  $time . '.svg';

        QrCode::size(300)
            ->generate(config('app.url') . '/images/QRCodes/' . $qr_code, 'images/QRCodes/' . $qr_code);

        $qr_path = public_path('images/QRCodes/' . $qr_code);

        $document->update([
            'implementor_date' => now()->format('Y-m-d'), 'implementor_comment' => $request->implementor_comment,
            'implementor' => auth()->id(), 'implementation_date' => $request->implementation_date, 'status' => 'Implemented',
            'qr_code' => $qr_code
        ]);

        foreach ($request->user_id as $key => $user_id) {
            Role::create([
                'user_id' => $user_id, 'doc_id' => $document->id
            ]);
        }

        $notify = $document->personIncharge;
        $data = [
            'intro'  => 'Dear ' . $notify->job_title . ',',
            'content'  => 'Your ' . $document->title . ' has been approved and ready for implementation Click the link below to implement or scan the attach QR Code',
            'link' =>  config('app.url') . '/Documents/I-can-access/' . $document->id,
            'email' => $notify->email,
            'name' => $notify->job_title,
            'subject'  => 'New Document for implementation confirmation',
        ];
        Mail::send('emails.email-jobs', $data, function ($message) use ($data, $qr_path) {
            $message->to($data['email'], $data['name'])
                ->subject($data['subject'])
                ->attach($qr_path);
        });

        Toastr::success('Upload Successful', 'Title', ["positionClass" => "toast-bottom-right"]);

        if ($request->link == 'yes') {
            return redirect()->route('document.link')->with(['doc' => $document]);
        } else {
            return redirect()->route(Session::get('route'));
        }
    }
}
