<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Document;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AccessController extends Controller
{
    public function fileReview(Document $document)
    {
        $path = storage_path('app/public/documents/' . $document->department . '/' . $document->title . '/' . $document->file);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $headers = ['Content-Type' => 'application/' . $extension];
        return response()->download($path, $document->document_no . '.' . $extension, $headers);
    }

    public function protectedFile(Document $document)
    {
        $has_access = \Arr::flatten(Role::where('user_id', auth()->id())->select('doc_id')->get()->toArray());
        if (in_array($document->id, $has_access)) {
            $path = storage_path('app/public/documents/' . $document->department . '/' . $document->title . '/' . $document->file);
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $headers = ['Content-Type' => 'application/' . $extension];
            return response()->download($path, $document->document_no . '.' . $extension, $headers);
        } else {
            abort(403, 'you have No permission to view this document');
        }
    }

    public function createUsers()
    {
        return view('welcome');
    }

    public function storeUsers(Request $request)
    {
        Excel::import(new UsersImport(), $request->file('users'));
        $users = User::select('job_title', 'email')->get();
        foreach ($users as $user) {
            $data = [
                'intro'  => 'Dear ' . $user->job_title . ',',
                'content'   => 'You have been successfully registered in the New Document Control App. Your Password is 123456. you can change it at anytime',
                'name' => $user->job_title,
                'email' => $user->email,
                'subject'  => 'Successful Registration in the Document control App'
            ];
            Mail::send('emails.email', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject($data['subject']);
            });
        }
    }
}
