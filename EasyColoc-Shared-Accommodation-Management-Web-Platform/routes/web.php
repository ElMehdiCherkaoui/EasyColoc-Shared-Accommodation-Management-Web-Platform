<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Owner\ExpensesController as OwnerExpensesController;
use App\Http\Controllers\Owner\RoommatesController as OwnerRoommatesController;
use App\Http\Controllers\Owner\CategoriesController as OwnerCategoriesController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AccommodationController as AdminAccommodationController;
use App\Http\Controllers\Admin\ExpenseController as AdminExpenseController;
use App\Http\Controllers\Member\BalancesController;
use App\Http\Controllers\Member\ExpensesController;
use App\Http\Controllers\Member\InvitationsController;

Route::get('/balances', [BalancesController::class, 'index'])->middleware(['auth', 'verified'])->name('member.balances');
Route::get('/expenses', [ExpensesController::class, 'index'])->middleware(['auth', 'verified'])->name('member.expenses');
Route::get('/invitations', [InvitationsController::class, 'index'])->middleware(['auth', 'verified'])->name('member.invitation');

Route::get('/expenses', [OwnerExpensesController::class, 'index'])->name('owner.expenses');
Route::get('/roommates', [OwnerRoommatesController::class, 'index'])->name('owner.members');
Route::get('/categories', [OwnerCategoriesController::class, 'index'])->name('owner.categories');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::get('/admin/users', [AdminUserController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.users.index');
Route::get('/admin/accommodations', [AdminAccommodationController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.accommodations.index');
Route::get('/admin/expenses', [AdminExpenseController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.expenses.index');
Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('owner.dashboard');
Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('member.dashboard');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if (strtolower($user->role?->name ?? '') === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->is_owner) {
        return redirect()->route('owner.dashboard');
    }

    $hasActiveMembership = $user->memberships()
        ->where('is_active', true)
        ->exists();

    if ($hasActiveMembership) {
        return redirect()->route('member.dashboard');
    }

    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});


require __DIR__ . '/auth.php';
