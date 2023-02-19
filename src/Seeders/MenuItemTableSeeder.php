<?php

namespace Reinholdjesse\Core\Seeders;

use Illuminate\Database\Seeder;
use Reinholdjesse\Core\Models\MenuItem;

class MenuItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = $this->findRoute('dashboard');
        if (! $value->exists) {
            $value->fill([
                'menu_id' => '1',
                'title' => 'Dashboard',
                'order' => '1',
                'route' => 'dashboard',
                'created_at' => date('Y-m-d H:i:s'),
            ])->save();
        }

        $value = $this->findRoute('package.core.menus');
        if (! $value->exists) {
            $value->fill([
                'menu_id' => '1',
                'title' => 'Menu',
                'order' => '2',
                'route' => 'package.core.menus',
                'created_at' => date('Y-m-d H:i:s'),
            ])->save();
        }

        $value = $this->findRoute('package.core.settings');
        if (! $value->exists) {
            $value->fill([
                'menu_id' => '1',
                'title' => 'Settings',
                'order' => '3',
                'route' => 'package.core.settings',
                'created_at' => date('Y-m-d H:i:s'),
            ])->save();
        }

        $value = $this->findRoute('package.core.componentes');
        if (! $value->exists) {
            $value->fill([
                'menu_id' => '1',
                'title' => 'Components overflow',
                'order' => '4',
                'route' => 'package.core.componentes',
                'created_at' => date('Y-m-d H:i:s'),
            ])->save();
        }
    }

    protected function findRoute($key)
    {
        return MenuItem::firstOrNew(['route' => $key]);
    }
}
