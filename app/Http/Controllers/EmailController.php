<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Mail\Email;
use App\Models\Application;
use App\Models\Notice;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    use HttpResponses;

    public function sendDisqualificationEmail(Application $application, SendEmailRequest $request)
    {
        $mailData = [
            'subject' => $request->subject,
            'body' => $request->body
        ];

        $application->notice()->create([
            'notice_type' => "Notice of Disqualification",
            'email_date' => date('Y-m-d')
        ]);

        Mail::to($request->recipient)->send(new Email($mailData));
        return $this->success('', 'Email was Successfully sent!', 200);
    }
}
