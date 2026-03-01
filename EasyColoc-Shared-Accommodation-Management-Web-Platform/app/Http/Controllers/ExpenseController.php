<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SharedAccommodation;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Membership;
use App\Models\Payment;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $colocation = SharedAccommodation::findOrFail($id);
        $categories = Category::where('shared_accommodation_id', $id)
            ->orderBy('name')
            ->get();
        return view('member.colocations.createExpense', compact('colocation', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        SharedAccommodation::findOrFail($id);
        $payerId = auth()->id();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',

        ]);

        $amount = (float) $validated['amount'];

        $expense = Expense::create([
            'title' => $validated['title'],
            'amount' => $amount,
            'expense_date' => now()->toDateString(),
            'paid' => false,
            'shared_accommodation_id' => $id,
            'user_id' => $payerId,
            'category_id' => $validated['category_id'],
        ]);

        $members = Membership::where('shared_accommodation_id', $id)
            ->where('is_active', true)
            ->pluck('user_id');

        $count = $members->count();
        $part = $count > 0 ? round($amount / $count, 2) : 0;

        foreach ($members as $memberId) {
            $isCreator = (int) $memberId === (int) $payerId;

            Payment::create([
                'shared_accommodation_id' => $id,
                'expense_id' => $expense->id,
                'receiver_user_id' => $memberId,
                'amount' => $part,
                'is_paid' => $isCreator,
                'payment_date' => $isCreator ? now()->toDateString() : null,
            ]);
        }
        

        return redirect()
            ->route('member.colocations.show', $id)
            ->with('success', 'Expense created and split to members.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function pay($paymentId)
    {
        $payment = Payment::with('expense')->findOrFail($paymentId);

        if (!$payment->is_paid) {
            $payment->update([
                'is_paid' => true,
                'payment_date' => now(),
            ]);
        }

        $allPaid = Payment::where('expense_id', $payment->expense_id)
            ->where('is_paid', false)
            ->doesntExist();

        if ($allPaid) {
            $payment->expense?->update(['paid' => true]);
        }

        return back()->with('success', 'Payment marked as paid.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($expenseId)
    {
        $expense = Expense::findOrFail($expenseId);
        $colocationId = $expense->shared_accommodation_id;
        $expense->delete();

        return redirect()
            ->route('member.colocations.show', $colocationId)
            ->with('success', 'Expense deleted successfully.');
    }
}
