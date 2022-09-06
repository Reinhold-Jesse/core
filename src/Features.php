<?php

namespace Reinholdjesse\Components;

class Features
{

    public static function enabled(string $feature)
    {
        return in_array($feature, config('tallui.features', []));
    }

    public static function managesUserSwitcher()
    {
        return static::enabled(static::userSwitcher());
    }

    public static function managesApiUsers()
    {
        return static::enabled(static::apiUsers());
    }

    public static function userSwitcher()
    {
        return 'user-switcher';
    }

    public static function apiUsers()
    {
        return 'api-users';
    }
}
