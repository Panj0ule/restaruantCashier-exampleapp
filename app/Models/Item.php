<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'desc'];

    /**
     * Get the transaction items for the item.
     */
    public function transactions()
    {
        return $this->hasMany(TransactionItem::class);
    }
}


