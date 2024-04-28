<?php

namespace App\Http\Controllers\v1\Currency;

use App\Http\Controllers\v1\ApiController;
use App\Http\Requests\Currency\Rate\CurrencyRateListRequest;
use App\Http\Resources\Currency\CurrencyResource;
use App\Models\Currency;
use App\Services\Currency\CurrencyService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Tag(
 *    name="Currencies",
 *    description="API Endpoints for Currencies"
 * )
 * */
final class CurrencyController extends ApiController
{
    /**
     * @OA\Get(
     *      path="/currencies",
     *      operationId="getCurrencies",
     *      tags={"Currencies"},
     *      summary="Get all currencies with current rates",
     *      description="Returns a list of all currencies along with their current rates. You can optionally filter currencies based on a specific date.",
     *      @OA\Parameter(
     *          name="filter",
     *          in="query",
     *          description="Filter currencies by date (format: Y-m-d, e.g., 2024-03-11)",
     *          required=false,
     *          @OA\Schema(
     *              type="string",
     *              format="date",
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/CurrencyWithRate")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Invalid parameter format",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Invalid date format. Date should be in Y-m-d format.")
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid filter parameter"
     *      )
     * )
     */
    public function index(
        CurrencyRateListRequest $request,
        CurrencyService $service,
    ): AnonymousResourceCollection
    {
        return CurrencyResource::collection($service->listFromDatabase($request->date));
    }

    /**
     * Display the specified currency.
     *
     * @param Currency $currency
     * @return CurrencyResource
     *
     * @OA\Get(
     *      path="/currencies/{currency:numCode}",
     *      operationId="getCurrency",
     *      tags={"Currencies"},
     *      summary="Get a specific currency by its numeric code",
     *      description="Returns a single currency based on its numCode.",
     *      @OA\Parameter(
     *          name="numCode",
     *          in="path",
     *          description="Numeric code of the currency",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="051"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CurrencyWithRate")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Currency not found"
     *      )
     * )
     */
    public function show(Currency $currency): CurrencyResource
    {
        return CurrencyResource::make($currency->load('rates'));
    }
}
