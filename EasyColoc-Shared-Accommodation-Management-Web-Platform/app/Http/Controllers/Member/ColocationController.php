<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\SharedAccommodation;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Payment;
class ColocationController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $memberships = Membership::with('sharedAccommodation')
            ->where('user_id', $userId)
            ->orderByDesc('joined_at')
            ->get();

        $hasActiveColoc = Membership::where('user_id', $userId)
            ->where('is_active', true)
            ->exists();

        return view('member.colocations.index', compact('memberships', 'hasActiveColoc'));
    }

    public function create()
    {
        return view('member.colocations.createForm');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $colocation = SharedAccommodation::create([
            'name' => $validated['name'],
            'status' => 'active',
            'cancelled_at' => null,
        ]);

        Membership::create([
            'user_id' => auth()->id(),
            'shared_accommodation_id' => $colocation->id,
            'role' => 'owner',
            'joined_at' => now(),
            'left_at' => null,
            'is_active' => true,
            'has_debt' => false,
        ]);
        $user = auth()->user();
        $user->is_owner;
        $user->update(['is_owner' => true]);

        return redirect()->route('member.colocations.show', $colocation->id);
    }

    public function show(Request $request, $id)
    {
        $userId = auth()->id();

        $colocation = SharedAccommodation::findOrFail($id);

        $isMember = Membership::where('user_id', $userId)
            ->where('shared_accommodation_id', $id)
            ->exists();

        $memberships = Membership::with('user')
            ->where('shared_accommodation_id', $id)
            ->where('is_active', true)
            ->orderBy('joined_at', 'asc')
            ->get();

        $monthFilter = $request->query('month');

        $expensesQ = Expense::with(['user', 'category'])
            ->where('shared_accommodation_id', $id);

        if ($monthFilter === 'current') {
            $expensesQ->whereMonth('expense_date', now()->month);
        } elseif ($monthFilter === 'last') {
            $lastMonth = now()->subMonth();
            $expensesQ->whereMonth('expense_date', $lastMonth->month);
        } else {
            $monthFilter = 'all';
        }

        $expenses = $expensesQ
            ->orderBy('paid')
            ->latest('expense_date')
            ->get();

        $payments = Payment::with(['expense.user', 'receiver'])
            ->where('shared_accommodation_id', $id)
            ->orderBy('is_paid')
            ->latest()
            ->get();

        return view('member.colocations.show', compact('colocation', 'memberships', 'expenses', 'payments', 'monthFilter'));
    }
    public function cancel($id)
    {
        $colocation = SharedAccommodation::findOrFail($id);
        $userId = auth()->id();

        $isOwner = Membership::where('shared_accommodation_id', $id)
            ->where('user_id', $userId)
            ->where('role', 'owner')
            ->where('is_active', true)
            ->exists();


        if (!$isOwner) {
            return back()->with('error', 'Only owner can cancel this colocation.');
        }


        $hasOtherMembers = Membership::where('shared_accommodation_id', $id)
            ->where('is_active', true)
            ->where('user_id', '!=', $userId)
            ->exists();

        if ($hasOtherMembers) {
            return back()->with('error', 'You cannot cancel while other members are still in this colocation.');
        }

        $colocation->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        $membership = Membership::where('shared_accommodation_id', $id)
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->first();

        $membership->update([
            'is_active' => false,
            'left_at' => now(),
        ]);

        $user = auth()->user();
        $user->is_owner;
        $user->update(['is_owner' => false]);

        return redirect()
            ->route('member.colocations.index')
            ->with('success', 'Colocation cancelled successfully.');
    }

    public function leave($id)
    {
        $userId = auth()->id();

        $membership = Membership::where('shared_accommodation_id', $id)
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->first();

        if ($membership->role === 'owner') {
            return back()->with('error', 'Owner cannot leave the colocation.');
        }

        $ownerMembership = Membership::where('shared_accommodation_id', $id)
            ->where('role', 'owner')
            ->where('is_active', true)
            ->first();

        $ownerId = $ownerMembership->user_id;



        Payment::where('shared_accommodation_id', $id)
            ->where('receiver_user_id', $userId)
            ->where('is_paid', false)
            ->update([
                'receiver_user_id' => $ownerId,
            ]);

        $leavingUserExpenses = Expense::where('shared_accommodation_id', $id)
            ->where('user_id', $userId)
            ->get();

        foreach ($leavingUserExpenses as $expense) {
            $expense->update(['paid' => true]);

            Payment::where('expense_id', $expense->id)
                ->where('is_paid', false)
                ->update([
                    'is_paid' => true,
                    'payment_date' => now()->toDateString(),
                ]);
        }

        $hasUnpaid = Payment::where('shared_accommodation_id', $id)
            ->where('receiver_user_id', $userId)
            ->where('is_paid', false)
            ->exists();
            
        auth()->user()->increment('reputation', $hasUnpaid ? -1 : 1);

        $membership->update([
            'is_active' => false,
            'left_at' => now(),
        ]);

        return redirect()
            ->route('member.colocations.index')
            ->with('success', 'You left the colocation successfully.');
    }

    public function kickMember($id, $memberUserId)
    {
        $ownerId = auth()->id();

        $memberMembership = Membership::where('shared_accommodation_id', $id)
            ->where('user_id', $memberUserId)
            ->where('is_active', true)
            ->first();

        Expense::where('shared_accommodation_id', $id)
            ->where('user_id', $memberUserId)
            ->update([
                'user_id' => $ownerId,
            ]);

        $ownerExpenseIds = Expense::where('shared_accommodation_id', $id)
            ->where('user_id', $ownerId)
            ->pluck('id');

        if ($ownerExpenseIds->isNotEmpty()) {
            Expense::whereIn('id', $ownerExpenseIds)->update([
                'paid' => true,
            ]);

            Payment::whereIn('expense_id', $ownerExpenseIds)
                ->where('is_paid', false)
                ->update([
                    'is_paid' => true,
                    'payment_date' => now()->toDateString(),
                ]);
        }

        $memberMembership->update([
            'is_active' => false,
            'left_at' => now(),
        ]);

        return back()->with('success', 'Member kicked successfully.');
    }
}
