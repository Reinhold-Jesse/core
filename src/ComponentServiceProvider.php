<?php

namespace Reinholdjesse\Components;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Reinholdjesse\Components\Contracts\BladeComponentCompiler;

class ComponentServiceProvider extends ServiceProvider
{
    private $path = __DIR__ . './../resources/views/components';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Route::group(['middleware' => ['web']], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'component');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../resources/views/components' => resource_path('/views/vendor/reinholdjesse/components')], 'components');

        //$this->registerBladeComponents();

    }

    private function registerBladeComponents()
    {
        foreach ($this->BladeComponentCompiler($this->path) as $element) {
            if (is_array($element)) {
                // array
                if (isset($element['date']) && !empty($element['date'])) {
                    foreach ($element['date'] as $value) {
                        Blade::component('component::' . $element['name'] . '.' . $value, $element['name'] . '.' . $value);
                    }
                }
            } else {
                // single file
                Blade::component('component::' . $element, $element);
            }
        }
    }

    private function bladeComponentCompiler(string $path)
    {
        $liste = [];

        foreach (scandir($path) as $index => $element) {
            if ($element != '..' && $element != '.') {
                $temp = [];
                if (is_dir($path . '/' . $element)) {
                    $temp['name'] = $element;
                    $temp['date'] = $this->bladeComponentCompiler($path . '/' . $element);
                } else {
                    $temp = str_replace('.blade.php', '', $element);
                }
                $liste[] = $temp;
            }
        }

        return $liste;
    }

}
