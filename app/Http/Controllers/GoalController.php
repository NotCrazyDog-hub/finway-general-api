<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Http\Resources\GoalResource;
use App\Http\Resources\GoalListResource;
use App\Http\Requests\GoalRequest;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = auth()->user()->goals()->get();
        return GoalListResource::collection($goals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GoalRequest $request)
    {
        $goal = auth()->user()->goals()->create($request->validated());
        return (new GoalResource($goal))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Goal $goal)
    {
        $this->authorize('view', $goal);
        return new GoalResource($goal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GoalRequest $request, Goal $goal)
    {
        $this->authorize('update', $goal);
        $goal->update($request->validated());
        return new GoalResource($goal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goal $goal)
    {
        $this->authorize('delete', $goal);
        $goal->delete();
        return response()->noContent();
    }
}
