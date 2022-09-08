<?php

namespace Reinholdjesse\Components;

use Illuminate\Support\Str;
use Reinholdjesse\Components\Models\Menu;
use Reinholdjesse\Components\Models\MenuItem;
use Reinholdjesse\Components\Models\Setting;

class Component
{

    protected $models = [
        'Menu' => Menu::class,
        'MenuItem' => MenuItem::class,
    ];

    public function model($name)
    {
        return app($this->models[Str::studly($name)]);
    }

    public function setting(string $key)
    {
        return Setting::where('key', $key)->pluck('value')->first();
    }

}
