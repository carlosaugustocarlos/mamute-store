<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;

Route::middleware('auth')->group(function () {
    Route::resource('stores', StoreController::class);
});