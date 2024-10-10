<?php

use App\Http\Controllers\ShelfController;
use Illuminate\Support\Facades\Route;

Route::middleware(['mockuserauth'])->group(function () {
    Route::get('/', function () {
        return inertia('Home');
    })->name('home');

    Route::get('/shelf/{id}', function ($id) {
        return inertia('Shelf', ['shelf' => ['id' => $id]]);
    })->name('shelf');
});

