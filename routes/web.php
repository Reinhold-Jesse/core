<?php

use Illuminate\Support\Facades\Route;

Route::get('componente/view', [\Reinholdjesse\Components\Controllers\ComponentesViewController::class, 'index']);
