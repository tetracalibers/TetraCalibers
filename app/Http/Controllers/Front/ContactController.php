<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSendMail;

class ContactController extends Controller
{
    public function confirm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'contents' => 'required'
        ]);

        $inputs = $request->all();

        return view('front.contact.confirm', compact('inputs'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'contents' => 'required'
        ]);

        $data = $request->all();

        Mail::to(env('MAIL_ADMIN'))->send(new ContactSendMail($data));

        $request->session()->regenerateToken();

        return view('front.contact.thanks');
    }
}
