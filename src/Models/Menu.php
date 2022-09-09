<?php

namespace Reinholdjesse\Components\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;
use Reinholdjesse\Components\Models\MenuItem;

class Menu extends Model
{
    use HasFactory;

    public function parent_items()
    {
        return $this->hasMany(MenuItem::class)
            ->whereNull('parent_id');
    }

    public function display(string $menuName, string $type = null)
    {
        $menu = Menu::where('name', $menuName)->with(['parent_items.children' => function ($query) {
            $query->orderBy('order');
        }])->first();

        $items = $menu->parent_items->sortBy('order');
        //dd($type);
        if (isset($type) && !empty($type)) {
            return new HtmlString(View::make('component::template.menu.' . $type, ['items' => $items])->render());
        } else {
            return new HtmlString(View::make('component::template.menu.default', ['items' => $items])->render());
        }

    }
}
