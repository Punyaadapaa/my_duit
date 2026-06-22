<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'currency',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    /**
     * Wallet ini milik satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Semua transaksi yang lewat wallet ini.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Tambah saldo (dipanggil pas ada transaksi income).
     */
    public function increaseBalance(float $amount): void
    {
        $this->increment('balance', $amount);
    }

    /**
     * Kurangi saldo (dipanggil pas ada transaksi expense).
     */
    public function decreaseBalance(float $amount): void
    {
        $this->decrement('balance', $amount);
    }
}