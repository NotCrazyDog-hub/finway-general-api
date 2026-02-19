<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

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
            'cashBoxId' => $this->id,
            'name' => $this->name,
            'amount' => $this->amount,
            'amountFormatted' => Number::currency($this->amount, 'BRL'),
            'createdAt' => $this->created_at
        ];
    }
}
