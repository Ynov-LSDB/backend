<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index()
    {
        $ranks = Rank::all();
        return response()->json([
            'success' => true,
            'message' =>count($ranks) . " ranks found",
            'data' => $ranks
        ], 200);
    }

    public function show($id)
    {
        $rank = Rank::find($id);
        if (!$rank) {
            return response()->json([
                'success' => false,
                'message' => 'Rank not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Rank found',
            'data' => $rank
        ], 200);
    }

    public function store(Request $request)
    {
        $rank = new Rank();
        $rank->name = $request->name;
        $rank->save();

        return response()->json([
            'success' => true,
            'message' => 'Rank created',
            'data' => $rank
        ], 200);
    }

    public function destroy($id)
    {
        $rank = Rank::find($id);
        if (!$rank) {
            return response()->json([
                'success' => false,
                'message' => 'Rank not found'
            ], 400);
        }
        $rank->delete();
        return response()->json([
            'success' => true,
            'message' => 'Rank deleted',
            'data' => $rank
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $rank = Rank::find($id);
        if (!$rank) {
            return response()->json([
                'success' => false,
                'message' => 'Rank not found'
            ], 400);
        }
        $rank->name = $request->name;
        $rank->save();
        return response()->json([
            'success' => true,
            'message' => 'Rank updated',
            'data' => $rank
        ], 200);
    }
}
