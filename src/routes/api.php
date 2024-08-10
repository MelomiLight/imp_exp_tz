<?php

use App\Http\Controllers\V1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('V1')->group(function () {
    Route::post('products/import', [ProductController::class, 'importExcel']);
    Route::get('products/', [ProductController::class, 'index']);
    Route::get('products/{product}', [ProductController::class, 'show']);
});
