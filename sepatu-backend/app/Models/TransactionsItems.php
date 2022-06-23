<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'product_id',
        'transactions_id',
    ];

    public function products() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
