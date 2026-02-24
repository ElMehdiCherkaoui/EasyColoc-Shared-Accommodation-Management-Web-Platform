<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AccommodationController extends Controller
{
    public function index()
    {
        return view('admin.shared_accommodations');
    }
}