<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_id',
        'category_id',
        'type',
        'amount',
        'note',
        'transaction_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    /**
     * Auto-update saldo wallet setiap kali ada transaksi baru/dihapus.
     * Jadi pas lo bikin Transaction::create(...), saldo wallet ikut keupdate
     * tanpa perlu nulis manual di controller.
     */
    protected static function booted(): void
    {
        static::created(function (Transaction $transaction) {
            $wallet = $transaction->wallet;
            if (! $wallet) {
                return;
            }

            $transaction->type === 'income'
                ? $wallet->increaseBalance((float) $transaction->amount)
                : $wallet->decreaseBalance((float) $transaction->amount);
        });

        static::deleted(function (Transaction $transaction) {
            $wallet = $transaction->wallet;
            if (! $wallet) {
                return;
            }

            // Kebalikan dari waktu dibuat, biar saldo balik normal
            $transaction->type === 'income'
                ? $wallet->decreaseBalance((float) $transaction->amount)
                : $wallet->increaseBalance((float) $transaction->amount);
        });

        static::updated(function (Transaction $transaction) {
            $wallet = $transaction->wallet;
            if (! $wallet) {
                return;
            }

            $originalAmount = (float) $transaction->getOriginal('amount');
            $originalType = $transaction->getOriginal('type');
            
            $newAmount = (float) $transaction->amount;
            $newType = $transaction->type;

            // Kembalikan efek transaksi lama
            if ($originalType === 'income') {
                $wallet->decreaseBalance($originalAmount);
            } else {
                $wallet->increaseBalance($originalAmount);
            }

            // Aplikasikan efek transaksi baru
            if ($newType === 'income') {
                $wallet->increaseBalance($newAmount);
            } else {
                $wallet->decreaseBalance($newAmount);
            }
        });
    }
}