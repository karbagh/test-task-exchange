<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class CurrencyControllerIndexTest extends TestCase
{
    public function testIndexUnauthenticated(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->getJson(route('currencies.list'));

        $response->assertStatus(ResponseStatus::HTTP_UNAUTHORIZED)
            ->assertJson(['message' => 'Unauthenticated.']);
    }
}
