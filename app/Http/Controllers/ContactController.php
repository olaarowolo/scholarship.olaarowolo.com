<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $adminEmail = config('mail.admin.address');

        Mail::to($adminEmail)->send(new ContactMail($request->all()));

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
