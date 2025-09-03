<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserControllerAD extends Controller
{
    public function index()
    {
        $users = User::where('email', '!=', 'admin@mindcare.com')->get();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function ban(User $user)
    {
        $user->is_banned = true;
        $user->save();
        return back()->with('success', 'User banned successfully.');
    }

    public function unban(User $user)
    {
        $user->is_banned = false;
        $user->save();
        return back()->with('success', 'User unbanned successfully.');
    }
}
