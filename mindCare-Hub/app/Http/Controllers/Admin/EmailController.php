<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::latest()->paginate(10);
        return view('admin.emails.index', compact('emails'));
    }

    public function create()
    {
        return view('admin.emails.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'recipient' => 'required|email',
        ]);

        Email::create($request->all());

        return redirect()->route('emails.index')->with('success', 'Email created successfully.');
    }

    public function show(Email $email)
    {
        return view('admin.emails.show', compact('email'));
    }

    public function edit(Email $email)
    {
        return view('admin.emails.edit', compact('email'));
    }

    public function update(Request $request, Email $email)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'recipient' => 'required|email',
        ]);

        $email->update($request->all());

        return redirect()->route('emails.index')->with('success', 'Email updated successfully.');
    }

    public function destroy(Email $email)
    {
        $email->delete();

        return redirect()->route('emails.index')->with('success', 'Email deleted successfully.');
    }
}
