<?php

if (!function_exists('setting')) {
    function setting($key)
    {
        return Reinholdjesse\Components\Facades\Component::setting($key);
    }
}

if (!function_exists('menu')) {
    function menu($menuName, $type = null, array $options = [])
    {
        return Reinholdjesse\Components\Facades\Component::model('Menu')->display($menuName, $type, $options);
    }
}

if (!function_exists('test')) {
    function test($text)
    {
        return $text;
    }
}
