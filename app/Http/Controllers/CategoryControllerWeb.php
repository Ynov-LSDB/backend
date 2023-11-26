<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryControllerWeb extends Controller
{
    public function index()
    {
        return view('category.index', [
            'categories' => Category::all()
        ]);
    }

    public function edit($id)
    {
        return view('category.edit', [
            'category' => Category::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('category.create');
    }
}
