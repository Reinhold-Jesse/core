<?php

namespace Reinholdjesse\Core\Seeders;

use Illuminate\Database\Seeder;
use Reinholdjesse\Core\Models\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = $this->findName('admin');
        if (! $value->exists) {
            $value->fill([
                'id' => 1,
                'name' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ])->save();
        }

        $value = $this->findName('site');
        if (! $value->exists) {
            $value->fill([
                'id' => 2,
                'name' => 'site',
                'created_at' => date('Y-m-d H:i:s'),
            ])->save();
        }
    }

    protected function findName($key)
    {
        return Menu::firstOrNew(['name' => $key]);
    }
}
