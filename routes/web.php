<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('dashboard')->name('package.core.')->group(function () {
    Route::get('componentes', [\Reinholdjesse\Core\Controllers\ComponentesViewController::class, 'index'])->name('componentes');
    Route::get('componente/resources/view', [\Reinholdjesse\Core\Controllers\ComponentesViewController::class, 'resources']);

    Route::get('settings', \Reinholdjesse\Core\Livewire\Setting\Index::class)->name('settings');

    Route::get('menu', \Reinholdjesse\Core\Livewire\Menu\Index::class)->name('menus');

    Route::get('menu/items/{id}', \Reinholdjesse\Core\Livewire\MenuItem\Index::class)->name('menu.items');
});

Route::view('/404', 'component::error.404')->name('404');
