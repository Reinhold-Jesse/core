<?php

use Illuminate\Support\Facades\Route;

Route::get('componente/package/view', [\Reinholdjesse\Components\Controllers\ComponentesViewController::class, 'index']);
Route::get('componente/resources/view', [\Reinholdjesse\Components\Controllers\ComponentesViewController::class, 'resources']);

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {

        Route::get('settings', \Reinholdjesse\Components\Livewire\Setting\Index::class)->name('component.settings');

        Route::get('menu', \Reinholdjesse\Components\Livewire\Menu\Index::class)->name('component.menus');

        Route::get('menu/items/{id}', \Reinholdjesse\Components\Livewire\MenuItem\Index::class)->name('component.menu.items');

    });
});
