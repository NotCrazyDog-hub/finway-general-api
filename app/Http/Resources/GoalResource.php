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
            'goal_id' => $this->id,
            'name' => $this->name,
            'steps' => $this->steps,
            'created_at' => $this->created_at
        ];
    }
}
