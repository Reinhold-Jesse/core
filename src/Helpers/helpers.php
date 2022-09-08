<?php

if (!function_exists('setting')) {
    function setting($key)
    {
        return Reinholdjesse\Components\Facades\Component::setting($key);
    }
}

if (!function_exists('menu')) {
    function menu($menuName)
    {
        return Reinholdjesse\Components\Facades\Component::model('Menu')->display($menuName);
    }
}

if (!function_exists('test')) {
    function test($text)
    {
        return $text;
    }
}
