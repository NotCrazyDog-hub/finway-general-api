<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Http\Resources\GoalResource;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = Goal::all();
        return GoalResource::collection($goals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $goal = Goal::create($request->all());
        return response()->json($goal);
    }

    /**
     * Display the specified resource.
     */
    public function show(Goal $goal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Goal $goal)
    {
        $goal->update($request->all());
        return new GoalResource($goal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();
        return response(null);
    }
}
