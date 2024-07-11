<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request) {
        
        $validatedData = $request->validate ([
            'name'=>'required',
            'email'=>'required|email',
            'message' => 'required',
        ]); 
        
        Mail::to('barbaraferrantemusic@gmail.com')->send(new ContactMail ($validatedData));
        
        return redirect()->route('email')->with('success', 'Messaggio inviato con successo. Grazie!');
}

}
