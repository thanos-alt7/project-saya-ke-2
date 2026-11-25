<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);

        return view('post.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $contact->update([
            'is_read' => true,
        ]);

        return view('post.contacts.show', compact('contact'));
    }
}
