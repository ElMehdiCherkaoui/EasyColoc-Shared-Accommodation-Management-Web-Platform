<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SharedAccommodation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id)
    {
        $colocation = SharedAccommodation::findOrFail($id);

        $categories = Category::where('shared_accommodation_id', $id)
            ->orderBy('name')
            ->get();

        return view('member.colocations.categories.index', compact('colocation', 'categories'));
    }

    public function create($id)
    {
        $colocation = SharedAccommodation::findOrFail($id);

        return view('member.colocations.categories.create', compact('colocation'));
    }

    public function store(Request $request, $id)
    {
        $colocation = SharedAccommodation::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create([
            'name' => $validated['name'],
            'shared_accommodation_id' => $colocation->id,
        ]);

        return redirect()
            ->route('member.colocations.categories.index', $id)
            ->with('success', 'Category created successfully.');
    }
}
