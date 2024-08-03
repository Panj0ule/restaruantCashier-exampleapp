<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
  public function index()
    {
    $items = Item::all();
    return view('items.index', compact('items'));
    }

  public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'desc' => 'nullable|string',
        ]);

        Item::create($validated);

        return redirect()->route('items.create')->with('success', 'Item added successfully!');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'desc' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('items.edit', $item)->with('success', 'Item updated successfully!');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.create')->with('success', 'Item deleted successfully!');
    }
}
