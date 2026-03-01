<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Expense;
use App\Models\Payment;

class memberDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $activeColocationsCount = Membership::where('user_id', $userId)
            ->count();

        $totalExpensesCount = Expense::where('user_id', $userId)->count();

        $totalOwe = (float) Payment::where('receiver_user_id', $userId)
            ->where('is_paid', false)
            ->sum('amount');

        return view('member.dashboard', compact(
            'activeColocationsCount',
            'totalExpensesCount',
            'totalOwe',
        ));
    }
}
