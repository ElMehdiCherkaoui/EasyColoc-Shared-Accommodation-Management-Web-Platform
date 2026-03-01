<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function ban(User $user)
    {
        if (auth()->id() === $user->id) {
            return back();
        }

        if ($user->is_owner) {
            return back()->with('success', 'Cant ban a owner.');
        }

        $user->update(['is_banned' => true]);

        return back()->with('success', 'User banned successfully.');
    }

    public function unban(User $user)
    {
        $user->update(['is_banned' => false]);

        return back();
    }
}