<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Store the submitted contact message
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    // Show all contacts for admin
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    // Mark contact as handled
    public function updateStatus($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->is_handled = !$contact->is_handled;
        $contact->save();

        return redirect()->back()->with('success', 'Message status updated!');
    }
}
