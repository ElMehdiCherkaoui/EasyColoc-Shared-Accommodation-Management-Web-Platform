<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('owner.categories');
    }
}