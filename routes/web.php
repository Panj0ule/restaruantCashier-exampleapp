<?php

use App\Models\Item;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/menu', function () {
    return view('menu', ['items' => Item::all()]);
})->middleware(['auth', 'verified'])->name('menu');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');


Route::middleware(['auth', 'admin'])->group(function () {
  Route::resource('items', ItemController::class)->except(['show']);
  Route::get('/users', [UserController::class, 'index'])->name('users.index');
  Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
  Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
  Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
  Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});


Route::middleware(['auth', 'admin'])->group(function () {
  // Show the form to create a new item
  Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

  // Show list of items
  Route::get('/items', [ItemController::class, 'index'])->name('items.index');

  // Store a new item
  Route::post('/items', [ItemController::class, 'store'])->name('items.store');

  // Show the form to edit an existing item
  Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');

  // Update an existing item
  Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');

  // Delete an item
  Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
});

require __DIR__.'/auth.php';
