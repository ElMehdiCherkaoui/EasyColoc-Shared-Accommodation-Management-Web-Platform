<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    public function index()
    {
        return view('admin.expenses');
    }
}