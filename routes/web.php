<?php

use Illuminate\Support\Facades\Route;

Route::get('componente/package/view', [\Reinholdjesse\Components\Controllers\ComponentesViewController::class, 'index']);
Route::get('componente/resources/view', [\Reinholdjesse\Components\Controllers\ComponentesViewController::class, 'resources']);

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {

        Route::get('settings', [\Reinholdjesse\Components\Controllers\SettingController::class, 'index'])->name('component.settings');

    });
});
