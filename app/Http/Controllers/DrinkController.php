<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    //index & show
    public function index()
    {
        $drinks = Drink::all();
        return response()->json([
            'success' => true,
            'message' =>count($drinks) . " drinks found",
            'data' => $drinks
        ], 200);
    }

    public function show($id)
    {
        $drink = Drink::find($id);
        if (!$drink) {
            return response()->json([
                'success' => false,
                'message' => 'Drink not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Drink found',
            'data' => $drink
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'degree' => 'numeric',
            'is_cuite_possible' => 'boolean',
            'nbr_ice_max' => 'integer',
        ]);
        $drink = new Drink();
        $drink->title = $request->title;
        $drink->description = $request->description;
        $drink->degree = $request->degree;
        $drink->imageURL = $request->imageURL;
        $drink->is_cuite_possible = $request->is_cuite_possible;
        $drink->nbr_ice_max = $request->nbr_ice_max;
        $drink->save();

        return response()->json([
            'success' => true,
            'message' => 'Drink created',
            'data' => $drink
        ], 200);
    }

    public function destroy($id)
    {
        $drink = Drink::find($id);
        if (!$drink) {
            return response()->json([
                'success' => false,
                'message' => 'Drink not found'
            ], 400);
        }
        $drink->delete();
        return response()->json([
            'success' => true,
            'message' => 'Drink deleted',
        ], 200);
    }

    public function update($id, Request $request)
    {
        $drink = Drink::find($id);
        if (!$drink) {
            return response()->json([
                'success' => false,
                'message' => 'Drink not found'
            ], 400);
        }
        $this->validate($request, [
            'degree' => 'numeric',
            'is_cuite_possible' => 'boolean',
            'nbr_ice_max' => 'integer',
        ]);
        $drink->title = $request->title;
        $drink->description = $request->description;
        $drink->degree = $request->degree;
        $drink->imageURL = $request->imageURL;
        $drink->is_cuite_possible = $request->is_cuite_possible;
        $drink->nbr_ice_max = $request->nbr_ice_max;
        $drink->save();

        return response()->json([
            'success' => true,
            'message' => 'Drink updated',
            'data' => $drink
        ], 200);
    }
}
