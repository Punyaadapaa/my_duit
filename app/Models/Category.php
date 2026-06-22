<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'icon',
        'color',
    ];

    /**
     * Pemilik kategori custom. Null kalau ini kategori default/global.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Scope: kategori yang boleh dipakai user tertentu
     * (kategori global ATAU kategori custom milik dia sendiri).
     */
    public function scopeAvailableFor($query, int $userId)
    {
        return $query->whereNull('user_id')->orWhere('user_id', $userId);
    }

    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }
}