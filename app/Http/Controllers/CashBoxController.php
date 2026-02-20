<?php

namespace App\Http\Controllers;

use App\Models\CashBox;
use App\Http\Resources\CashBoxResource;
use App\Http\Requests\CashBoxRequest;
use Illuminate\Support\Number;

class CashBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashBoxes = auth()->user()->cash_boxes()->get();
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
    public function store(CashBoxRequest $request)
    {
        $cashBox = auth()->user()->cash_boxes()->create($request->validated());
        return (new CashBoxResource($cashBox))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CashBox $cashBox)
    {
        $this->authorize('view', $cashBox);
        return new CashBoxResource($cashBox);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CashBoxRequest $request, CashBox $cashBox)
    {
        $this->authorize('update', $cashBox);
        $cashBox->update($request->validated());
        return new CashBoxResource($cashBox);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashBox $cashBox)
    {
        $this->authorize('delete', $cashBox);
        $cashBox->delete();
        return response()->noContent();
    }
}
