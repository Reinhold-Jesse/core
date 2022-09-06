<?php

namespace Reinholdjesse\Components;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Reinholdjesse\Components\Livewire\Element\MarkdownX;
use Reinholdjesse\Components\Livewire\Element\Select2;
use Reinholdjesse\Components\View\Components\AppLayout;
use Reinholdjesse\Components\View\Components\DashboardLayout;
use Reinholdjesse\Components\View\Components\Element\Datepicker;
use Reinholdjesse\Components\View\Components\Element\DropFile;
use Reinholdjesse\Components\View\Components\Element\Modal;
use Reinholdjesse\Components\View\Components\GuestLayout;

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
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

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
        $this->publishes([
            __DIR__ . '/../resources/views/components' => resource_path('/views/components'),
            __DIR__ . '/View/Components/Element' => app_path('View/Components/Element'),
        ], 'components.publishes');

        $this->publishes([
            __DIR__ . '/../resources/views/layouts' => resource_path('/views/layouts'),
            __DIR__ . '/View/Components/AppLayout.php' => app_path('View/Components/AppLayout.php'),
            __DIR__ . '/View/Components/DashboardLayout.php' => app_path('View/Components/DashboardLayout.php'),
            __DIR__ . '/View/Components/GuestLayout.php' => app_path('View/Components/GuestLayout.php')], 'components.publishes.layouts');

        $this->publishes([
            __DIR__ . '/Livewire/Navigation.php' => app_path('Http/Livewire/Navigation.php'),
            __DIR__ . '/../resources/views/livewire/navigation.blade.php' => resource_path('views/livewire/navigation.blade.php'),
        ], 'components.publishes.navigation');

        $this->publishes([
            # CSS & Javascript
            __DIR__ . '/../resources/css/app.css' => resource_path('css/app.css'),
            __DIR__ . '/../resources/css/dashboard.css' => resource_path('css/dashboard.css'),
            __DIR__ . '/../resources/js/app.js' => resource_path('js/app.js'),
            __DIR__ . '/../resources/js/dashboard.js' => resource_path('js/dashboard.js'),
            __DIR__ . '/../tailwind.config.js' => base_path('tailwind.config.js'),
            # configs
            __DIR__ . '/../config/markdownx.php' => config_path('markdownx.php'),
            __DIR__ . '/../config/tallui.php' => config_path('tallui.php'),
        ], 'components.config');

        // einzelne classen einbinden
        Blade::component('component::element.modal', Modal::class);
        Blade::component('component::element.datepicker', Datepicker::class);
        Blade::component('component::element.drop-file', DropFile::class);

        Blade::component('component::layouts.app', AppLayout::class);
        Blade::component('component::layouts.dashboard', DashboardLayout::class);
        Blade::component('component::layouts.guest', GuestLayout::class);

        //$this->registerBladeComponents();

        // werden alle eingebunden
        // Blade::componentNamespace('Reinholdjesse\\Components\\View\\Components\\Element', 'component');

        Livewire::component('markdown-x', MarkdownX::class);
        Livewire::component('select2', Select2::class);
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
