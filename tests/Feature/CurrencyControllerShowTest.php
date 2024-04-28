<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class CurrencyControllerShowTest extends TestCase
{
    public function testShowUnauthenticated(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->getJson(route('currencies.currencies.show', ['currency' => '051']));

        $response->assertStatus(ResponseStatus::HTTP_UNAUTHORIZED)
            ->assertJson(['message' => 'Unauthenticated.']);
    }
}
