<?php

namespace App\Http\Resources\Currency\Rate;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'value' => $this->value,
            'vunitRate' => $this->vunit_rate,
            'date' => $this->created_at->toDateString(),
        ];
    }
}
