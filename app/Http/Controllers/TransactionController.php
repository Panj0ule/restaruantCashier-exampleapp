<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Item;
use Illuminate\Support\Facades\Log;


class TransactionController extends Controller
{

  public function index() // show transaction history
    {
        $transactions = Transaction::with('items.item')->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

  public function store(Request $request)
  {
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'items' => 'required|array',
        'items.*.id' => 'required|exists:items,id',
        'items.*.quantity' => 'required|integer|min:0',
    ]);

    // Filter out items with quantity zero
    $filteredItems = array_filter($validated['items'], function($item) {
        return $item['quantity'] > 0;
    });

    if (empty($filteredItems)) {
        return response()->json(['success' => false, 'message' => 'No items with quantity selected.']);
    }

    // Create the transaction
    $transaction = Transaction::create([
        'customer_name' => $validated['customer_name'],
        'total_price' => array_sum(array_map(function ($item) {
            return $item['quantity'] * Item::find($item['id'])->price;
        }, $filteredItems)),
    ]);

    // Attach items to the transaction
    foreach ($filteredItems as $item) {
        $itemModel = Item::find($item['id']);
        $transaction->items()->create([
            'item_id' => $item['id'],
            'quantity' => $item['quantity'],
            'item_price' => $itemModel->price,
        ]);
    }

    return response()->json(['success' => true]);
  }




}
