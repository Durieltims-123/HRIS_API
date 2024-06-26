<?php

namespace App\Http\Controllers;

use App\Mail\LetterEmail;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendDisqualificationEmail(Application $application)
    {
        $details = [
            'title' => 'Laravel Email',
            'body' => 'This is a test email sent from Laravel using Gmail.'
        ];
        Mail::to('durieltims@icloud.com')->send(new LetterEmail($details));

        return $this->success('', 'Successfully Sent Email.', 200);
    }
}
