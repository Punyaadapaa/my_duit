<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'base_currency',
        'target_currency',
        'rate',
        'change_percent',
        'fetched_at',
    ];

    protected $casts = [
        'rate' => 'decimal:4',
        'change_percent' => 'decimal:4',
        'fetched_at' => 'datetime',
    ];

    /**
     * Ambil kurs terbaru untuk pasangan mata uang tertentu.
     * Contoh: ExchangeRate::latestFor('USD', 'IDR')
     */
    public static function latestFor(string $base = 'USD', string $target = 'IDR'): ?self
    {
        return static::where('base_currency', $base)
            ->where('target_currency', $target)
            ->latest('fetched_at')
            ->first();
    }
}