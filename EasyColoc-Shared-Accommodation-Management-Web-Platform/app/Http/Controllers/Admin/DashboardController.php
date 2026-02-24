<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {

        $users = \App\Models\User::count();
        $banned_users = \App\Models\User::where('is_banned', true)->count();
        $accommodations = \App\Models\SharedAccommodation::where('status', 'active')->count();
        $expenses_total = \App\Models\Expense::sum('amount');
        return view('admin.dashboard', compact('users', 'banned_users', 'accommodations', 'expenses_total'));
    }
}