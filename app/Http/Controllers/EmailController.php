<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Mail\LetterEmail;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendDisqualificationEmail(Application $application)
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('durieltims@gmail.com')->send(new DemoMail($mailData));


        // return $this->success('', 'Successfully Sent Email.', 200);



        // $name ="Test Name";
        // $email = "durieltims@icloud.com";
        // $sub = "Test Subject";
        // $mess = "Test Message";
        // $mailData = [
        //     'url' => 'https://mywebsite.com/',
        // ];
        // $send_mail = "sahincseiu@gmail.com";
        // Mail::to($send_mail)->send(new SendMail($name, $email, $sub, $mess));
        // $senderMessage = "thanks for your message , we will reply you in later";
        // Mail::to($email)->send(new
        // SendMessageToEndUser($name, $senderMessage, $mailData));
    }
}
