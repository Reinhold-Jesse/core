<?php

namespace Reinholdjesse\Components;

use Reinholdjesse\Components\Models\Setting;

class Component
{

    public function setting(string $key)
    {
        return Setting::where('key', $key)->pluck('value')->first();
    }
}
