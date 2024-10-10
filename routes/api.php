<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ShelfController;
use Illuminate\Support\Facades\Route;

Route::apiResource('shelves', ShelfController::class);

Route::get('books', [BookController::class, 'index']);

Route::post('shelves/{shelf}/book/{book}', [ShelfController::class, 'addBook']);
Route::delete('shelves/{shelf}/book/{book}', [ShelfController::class, 'removeBook']);
