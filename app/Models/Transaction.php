<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'total_price'];

    /**
     * Get the items for the transaction.
     */
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
