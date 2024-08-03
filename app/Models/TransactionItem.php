<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'item_id', 'quantity', 'item_price'];

    /**
     * Get the transaction that owns the item.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Get the item that is associated with the transaction item.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
