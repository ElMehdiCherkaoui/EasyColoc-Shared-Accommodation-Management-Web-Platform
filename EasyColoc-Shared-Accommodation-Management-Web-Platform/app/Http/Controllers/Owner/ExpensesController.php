<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;

class ExpensesController extends Controller
{
    public function index()
    {
        return view('owner.expenses');
    }
}