<?php

namespace App\Http\Controllers;

use App\Models\CashBox;
use App\Http\Resources\CashBoxResource;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class CashBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashBoxes = CashBox::all();
        $total = $cashBoxes->sum('amount');
        return response()->json([
            'total' => $total,
            'total_formatted' => Number::currency($total, 'BRL'),
            'data' => CashBoxResource::collection($cashBoxes)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CashBox $cashBox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CashBox $cashBox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashBox $cashBox)
    {
        //
    }
}
