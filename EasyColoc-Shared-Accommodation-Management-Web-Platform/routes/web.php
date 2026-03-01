<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\memberDashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\Member\CategoryController;

use App\Http\Controllers\Member\ColocationController;



Route::get('/colocations', [ColocationController::class, 'index'])->middleware(['auth', 'verified'])->name('member.colocations.index');
Route::get('/colocations/create', [ColocationController::class, 'create'])->middleware(['auth', 'verified'])->name('member.colocations.create');
Route::get('/colocations/{id}', [ColocationController::class, 'show'])->middleware(['auth', 'verified'])->name('member.colocations.show');
Route::post('/colocations/store', [ColocationController::class, 'store'])->middleware(['auth', 'verified'])->name('member.colocations.store');
Route::post('/colocations/{id}/cancel', [ColocationController::class, 'cancel'])->middleware(['auth', 'verified'])->name('member.colocations.cancel');
Route::post('/colocations/{id}/leave', [ColocationController::class, 'leave'])->middleware(['auth', 'verified'])->name('member.colocations.leave');
Route::post('/colocations/{id}/members/{memberUserId}/kick', [ColocationController::class, 'kickMember'])->middleware(['auth', 'verified'])->name('member.colocations.members.kick');
Route::get('/colocation/{id}/categories', [CategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('member.colocations.categories.index');
Route::get('/colocation/{id}/categories/create', [CategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('member.colocations.categories.create');
Route::post('/colocation/{id}/categories', [CategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('member.colocations.categories.store');
Route::get('/colocation/{id}/invitation', [InvitationController::class, 'index'])->middleware(['auth', 'verified'])->name('member.colocations.invitation.index');
Route::get('/colocation/{id}/expense', [ExpenseController::class, 'create'])->middleware(['auth', 'verified'])->name('member.colocations.expense');
Route::post('/colocation/{id}/expense/store', [ExpenseController::class, 'store'])->middleware(['auth', 'verified'])->name('member.colocations.expense.store');
Route::post('/expenses/{expenseId}/delete', [ExpenseController::class, 'destroy'])->middleware(['auth', 'verified'])->name('member.expenses.destroy');
Route::post('/payments/{paymentId}/pay', [ExpenseController::class, 'pay'])->middleware(['auth', 'verified'])->name('member.payments.pay');
Route::post('/colocation/{id}/invitation', [InvitationController::class, 'store'])->middleware(['auth', 'verified'])->name('member.colocations.invitation.store');
Route::get('/invited/{token}', [InvitationController::class, 'show'])->name('invitations.show');
Route::post('/invited/{token}/accept', [InvitationController::class, 'accept'])->middleware(['auth', 'verified'])->name('invitations.accept');
Route::post('/invited/{token}/decline', [InvitationController::class, 'decline'])->name('invitations.decline');
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::get('/admin/users', [AdminUserController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.users.index');
Route::post('/users/{user}/ban', [AdminUserController::class, 'ban'])->name('admin.users.ban');
Route::post('/users/{user}/unban', [AdminUserController::class, 'unban'])->name('admin.users.unban');
Route::get('/dashboard', [memberDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';
