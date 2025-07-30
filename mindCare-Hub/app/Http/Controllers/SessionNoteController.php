<?php

namespace App\Http\Controllers;

use App\Models\SessionNote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SessionNoteController extends Controller
{
    public function index()
    {
        $notes = SessionNote::where('counselor_id', Auth::user()->id)->with('user')->latest()->get();
        return view('counselor.session-notes.index', compact('notes'));
    }

    public function create()
    {
        $users = User::all();
        return view('counselor.session-notes.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_date' => 'required|date',
            'note' => 'required|string',
        ]);

        SessionNote::create([
            'counselor_id' => Auth::user()->id,
            'user_id' => $request->user_id,
            'session_date' => $request->session_date,
            'note' => $request->note,
        ]);

        return redirect()->route('counselor.session-notes')->with('success', 'Session note added.');
    }

    public function edit(SessionNote $note)
    {
        $this->authorize('update', $note);
        $users = User::all();
        return view('counselor.session-notes.edit', compact('note', 'users'));
    }

    public function update(Request $request, SessionNote $note)
    {
        $this->authorize('update', $note);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_date' => 'required|date',
            'note' => 'required|string',
        ]);

        $note->update($request->only(['user_id', 'session_date', 'note']));

        return redirect()->route('counselor.session-notes')->with('success', 'Note updated.');
    }

    public function destroy(SessionNote $note)
    {
        $note->delete();
        return back()->with('success', 'Note deleted.');
    }
}
