<?php

namespace Reinholdjesse\Core\Livewire\MenuItem;

use Livewire\Component;
use Reinholdjesse\Core\Helpers\addLivewireControlleFunctions;
use Reinholdjesse\Core\Models\Menu;
use Reinholdjesse\Core\Models\MenuItem;

class Index extends Component
{

    use addLivewireControlleFunctions;

    public $listOrder = [];

    public $menu;

    public $content;

    public $openEdit = false;

    public $editId = null;

    public $title;
    public $url;
    public $target;
    public $parent_id;
    public $order;
    public $route;

    protected $rules = [
        'title' => 'required|min:3',
        'url' => 'nullable|url|max:255',
        'target' => 'nullable|string|max:10',
        'parent_id' => 'nullable|numeric',
        'order' => 'required|numeric',
        'route' => 'nullable|string|max:255',
    ];

    public function mount(Menu $id)
    {
        $this->menu = $id;
    }

    public function render()
    {
        $this->content = MenuItem::where('menu_id', $this->menu->id)->orderBy('order')->get();

        return view('component::livewire.menu-item.index')->layout('component::layouts.dashboard');
    }

    public function create()
    {
        $this->clearValue();
        $this->openEditWindow();

        $this->order = MenuItem::where('menu_id', $this->menu->id)->count() + 1;
    }

    public function edit(MenuItem $menuItem)
    {
        $this->clearValue();

        $this->editId = $menuItem->id;

        $this->title = $menuItem->title;
        $this->url = $menuItem->url;
        $this->target = $menuItem->target;
        $this->parent_id = $menuItem->parent_id;
        $this->order = $menuItem->order;
        $this->route = $menuItem->route;

        $this->openEditWindow();
    }

    public function update()
    {
        $this->validate();

        if (!empty($this->editId)) {
            //update
            $query = MenuItem::find($this->editId);
        } else {
            // create
            $query = new MenuItem;
            $query->menu_id = $this->menu->id;
        }

        $query->title = $this->title;
        $query->url = $this->url;

        if (!empty($this->target)) {
            $query->target = $this->target;
        }

        $query->parent_id = $this->parent_id;
        $query->order = $this->order;
        $query->route = $this->route;

        if ($query->save()) {

            $this->cloasEditWindow();
            $this->clearValue();

            // TODO: flash message
            $this->bannerMessage('success', 'Menu wurde erfolgreich erstellt.');
        } else {
            // TODO: flash message
            $this->bannerMessage('success', 'Menu wurde erfolgreich aktualisiert.');
        }
    }

    public function deleteEntry(MenuItem $menuItem)
    {
        if ($menuItem->delete()) {
            // TODO: flash message
        } else {
            // TODO: flash message
        }
    }

    private function clearValue()
    {
        $this->editId = null;

        $this->title = null;
        $this->url = null;
        $this->target = null;
        $this->parent_id = null;
        $this->order = null;
        $this->route = null;
    }

    public function reorder($orderedIds)
    {

        foreach ($orderedIds as $element) {
            MenuItem::where('id', $element['value'])->update([
                'order' => $element['order'],
            ]);
        }
        //dd($orderedIds);
    }

}
