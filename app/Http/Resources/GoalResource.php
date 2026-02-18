<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'goalId' => $this->id,
            'name' => $this->name,
            'steps' => $this->when($request->routeIs('goals.show'), $this->steps ?? []),
            'createdAt' => $this->created_at
        ];
    }
}
