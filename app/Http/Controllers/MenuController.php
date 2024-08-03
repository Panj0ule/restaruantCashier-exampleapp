<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class MenuController extends Controller
{
    public function userIndex()
    {
        $items = Item::all();
        return view('menu', compact('items'));
    }

    public function adminIndex()
    {
        $items = Item::all();
        return view('admin.menu', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'desc' => 'required|string',
        ]);

        Item::create($request->only('name', 'price', 'desc'));

        return redirect()->route('admin.menu')->with('success', 'Menu item added successfully!');
    }
}
