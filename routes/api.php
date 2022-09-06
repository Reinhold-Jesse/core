<?php

use Illuminate\Support\Facades\Route;
use Reinholdjesse\Components\Features;

if (Features::managesApiUsers()) {
    Route::middleware(['auth'])->group(function () {
        Route::prefix('api')->group(function () {

            Route::get('/user/{id}', function (int $id) {
                if (is_int($id)) {
                    return \App\Models\User::where('id', $id)->get()->first();
                }
            });

            Route::get('/users', function () {
                return \App\Models\User::all();
            });
        });
    });
}
