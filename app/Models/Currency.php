<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Currency extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'num_code',
        'char_code',
        'nominal',
        'name',
    ];

    public function currentRate(): HasOne
    {
        return $this->hasOne(Rate::class)->ofMany();
    }

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }
}
