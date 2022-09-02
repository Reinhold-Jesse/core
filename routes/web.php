<?php

use Illuminate\Support\Facades\Route;

Route::get('componente/package/view', [\Reinholdjesse\Components\Controllers\ComponentesViewController::class, 'index']);
Route::get('componente/resources/view', [\Reinholdjesse\Components\Controllers\ComponentesViewController::class, 'resources']);
