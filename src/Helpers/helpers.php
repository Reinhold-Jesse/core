<?php

if (!function_exists('setting')) {
    function setting($key)
    {
        return Reinholdjesse\Core\Facades\Component::setting($key);
    }
}

if (!function_exists('menu')) {
    function menu(string $menuName, string $type = null)
    {
        return Reinholdjesse\Core\Facades\Component::model('Menu')->display($menuName, $type);
    }
}

if (!function_exists('test')) {
    function test($text)
    {
        return $text;
    }
}
