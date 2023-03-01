<?php

namespace Reinholdjesse\Core;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/core.php', 'core');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        //$this->loadSeedsFrom(__DIR__.'/../database/seeders');

        Route::group(['middleware' => ['web']], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'component');

        $this->loadHelpers();

        $this->app->singleton('component', function () {
            return new Component();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/views/components' => resource_path('/views/components'),
            __DIR__.'/View/Components/Element' => app_path('View/Components/Element'),
        ], 'core.publishes');

        // $this->publishes([
        //     __DIR__ . '/../resources/views/layouts' => resource_path('/views/layouts'),
        //     __DIR__ . '/View/Components/AppLayout.php' => app_path('View/Components/AppLayout.php'),
        //     __DIR__ . '/View/Components/DashboardLayout.php' => app_path('View/Components/DashboardLayout.php'),
        //     __DIR__ . '/View/Components/GuestLayout.php' => app_path('View/Components/GuestLayout.php')], 'components.publishes.layouts');

        $this->publishes([
            // CSS & Javascript
            __DIR__.'/../resources/css/app.css' => resource_path('css/app.css'),
            __DIR__.'/../resources/css/dashboard.css' => resource_path('css/dashboard.css'),
            __DIR__.'/../resources/css/componentes/animations.css' => resource_path('css/componentes/animations.css'),
            __DIR__.'/../resources/js/app.js' => resource_path('js/app.js'),
            __DIR__.'/../resources/js/copy.js' => resource_path('js/copy.js'),
            __DIR__.'/../resources/js/tinymce.js' => resource_path('js/tinymce.js'),
            __DIR__.'/../resources/js/dashboard.js' => resource_path('js/dashboard.js'),
            __DIR__.'/../tailwind.config.js' => base_path('tailwind.config.js'),
            __DIR__.'/../vite.config.js' => base_path('vite.config.js'),
            // view
            __DIR__.'/../resources/views/backend/dashboard.blade.php' => resource_path('views/dashboard.blade.php'),
            // configs
            __DIR__.'/../config/markdownx.php' => config_path('markdownx.php'),
            __DIR__.'/../config/tallui.php' => config_path('tallui.php'),
        ], 'core.install');

        // blade componente
        $this->bootBladeComponents();

        // livewire componente
        $this->bootLivewireComponents();

        // werden alle eingebunden
        // Blade::componentNamespace('Reinholdjesse\\Components\\View\\Components\\Element', 'component');

        // Componente
        // Livewire::component('markdown-x', \Reinholdjesse\Core\Livewire\Element\MarkdownX::class);
        // Livewire::component('select2', \Reinholdjesse\Core\Livewire\Element\Select2::class);

        // Controller
        // Livewire::component('component::setting.index', \Reinholdjesse\Core\Livewire\Setting\Index::class);

        // Livewire::component('component::menu.index', \Reinholdjesse\Core\Livewire\Menu\Index::class);
        // Livewire::component('component::menu.edit', \Reinholdjesse\Core\Livewire\Menu\Edit::class);

        Livewire::component('component::menu-item.index', \Reinholdjesse\Core\Livewire\MenuItem\Index::class);
        // Livewire::component('component::menu-item.edit', \Reinholdjesse\Core\Livewire\MenuItem\Edit::class);
    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    private function bootBladeComponents()
    {
        foreach (config('core.components', []) as $alias => $component) {
            Blade::component(config('core.prefix').$alias, $component);
        }
    }

    private function bootLivewireComponents()
    {
        foreach (config('core.livewire', []) as $alias => $component) {
            Livewire::component(config('core.prefix').$alias, $component);
        }
    }
}
