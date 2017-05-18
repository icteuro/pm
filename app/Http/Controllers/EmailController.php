<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller {

	public function sendMailWithoutAttach(Request $request)
    {
        
        $content = "Your user account has successfully created. \nUsername: ".$request->email." \nPassword: ".$request->password;
        $to = $request->email;
        Mail::send('emails.sendmail', ['title' => 'Account Created!', 'content' => $content], function ($message) use($to)
            {
                $message->subject('New account created for '.$to);
                $message->from('info@ict-euro.com', 'Info');

                $message->to($to);

            });

        return response()->json(['message' => 'Request completed']);
    }

    public function sendMailWithAttach(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        //Grab uploaded file
        $attach = $request->file('file');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message) use ($attach)
        {

            $message->from('me@gmail.com', 'Christian Nwamba');

            $message->to('chrisn@scotch.io');

            //Attach file
            $message->attach($attach);

            //Add a subject
            $message->subject("Hello from Scotch");

        });
    }

}
