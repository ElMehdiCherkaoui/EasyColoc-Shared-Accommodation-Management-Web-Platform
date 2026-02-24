<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BalancesController extends Controller
{
    public function index()
    {
        return view('member.balances');
    }
}