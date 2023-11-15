<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;
class EmailController extends Controller
{ public function sendEmail(Request $request)
    {
        $myEmail = $request->input('recipient');

        $details = [
    
            'title' => $request->subject,
            'recipient' => $request->recipient,
            'message' => $request->message,
            'document' => $request->document,
           
    
        ];
    
    
        
        Mail::to($myEmail)->send(new MyEmail($details));
        return redirect('/email');  
    }
}
