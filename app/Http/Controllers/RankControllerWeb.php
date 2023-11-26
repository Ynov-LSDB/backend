<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;

class RankControllerWeb extends Controller
{
    public function index()
    {
        return view('rank.index', [
            'ranks' => Rank::all()
        ]);
    }

    public function edit($id)
    {
        return view('rank.edit', [
            'rank' => Rank::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('rank.create');
    }
}
