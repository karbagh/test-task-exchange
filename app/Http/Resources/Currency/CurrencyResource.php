<?php

namespace App\Http\Resources\Currency;

use App\Http\Resources\Currency\Rate\RateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * @OA\Schema(
     *      schema="CurrencyWithRate",
     *      title="Currency with Rate",
     *      description="Represents a currency along with its rate.",
     *      @OA\Property(
     *          property="name",
     *          type="string",
     *          description="The name of the currency."
     *      ),
     *      @OA\Property(
     *          property="numCode",
     *          type="integer",
     *          description="The numeric code of the currency."
     *      ),
     *      @OA\Property(
     *          property="charCode",
     *          type="string",
     *          description="The character code of the currency."
     *      ),
     *      @OA\Property(
     *          property="nominal",
     *          type="integer",
     *          description="The nominal value of the currency."
     *      ),
     *      @OA\Property(
     *          property="rate",
     *          type="number",
     *          description="The exchange rate of the currency."
     *      ),
     *      @OA\Property(
     *          property="rates",
     *          type="string",
     *          format="date",
     *          description="The date for which the rate is applicable (format: Y-m-d)."
     *      ),
     * )
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'numCode' => $this->num_code,
            'carCode' => $this->char_code,
            'nominal' => $this->nominal,
            'rate' => RateResource::make($this->whenLoaded('currentRate')),
            'rates' => RateResource::collection($this->whenLoaded('rates')),
        ];
    }
}
