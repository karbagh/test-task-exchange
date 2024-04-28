<?php

namespace App\Repositories\Currency;

use App\Models\Currency;
use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class CurrencyRepository
{
    public static function baseQuery(): Builder
    {
        return Currency::query();
    }

    public function getListWithCurrentRate(?string $date = null): EloquentCollection
    {
        return self::baseQuery()
            ->with(['currentRate' => fn(HasOne $q) => $q->whereDate('created_at', $date ?? Carbon::today())])
            ->get();
    }

    public function insertCurrencies(array $items): void
    {
        self::baseQuery()->upsert($items, ['num_code'], ['name', 'nominal', 'char_code']);
    }

    public function pluckIds(): Collection
    {
        return self::baseQuery()->pluck('id', 'num_code');
    }

    public function insertCurrencyValues(array $items): void
    {
        Rate::query()->whereDate('created_at', Carbon::today())->delete();
        Rate::query()->insert($items);
    }
}
