<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'body' => 'required',
        ]);

        Mail::send([], [], function ($message) use ($data) {
            $message->from('Admin@caramyaeon.com.my', 'Cara');
            $message->to($data['email']);
            $message->subject($data['subject']);
            $message->html($data['body']); // Use the html method to set the body
        });

        return response()->json(['message' => 'Email sent successfully']);
    }

}
