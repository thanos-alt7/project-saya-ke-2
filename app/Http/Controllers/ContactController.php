<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Jobs\SendContactNotification;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'nullable|max:200',
            'message' => 'required|min:10',
        ]);

        $contact = Contact::create($validated);

        SendContactNotification::dispatch($contact);

        return back()->with(
            'success',
            'Pesan berhasil dikirim. Terima kasih!'
        );
    }
}
