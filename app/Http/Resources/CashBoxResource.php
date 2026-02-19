<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashBoxResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'cashBoxesId' => $this->id,
            'name' => $this->name,
            'amount' => $this->amount,
            'createdAt' => $this->created_at
        ];
    }
}
