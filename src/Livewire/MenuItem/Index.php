<?php

namespace Reinholdjesse\Core\Livewire\MenuItem;

use Illuminate\View\View;
use Livewire\Component;
use Reinholdjesse\Core\Models\Menu;
use Reinholdjesse\Core\Models\MenuItem;
use Reinholdjesse\Core\Traits\addLivewireControlleFunctions;

class Index extends Component
{
    use addLivewireControlleFunctions;

    public array $listOrder = [];

    public $menu;

    public $content;

    public bool $openEdit = false;

    public ?int $editId = null;

    public ?string $title;

    public ?string $url = null;

    public ?string $target = null;

    public ?int $parent_id = null;

    public ?int $order = null;

    public ?string $route = null;

    protected $rules = [
        'title' => 'required|min:3',
        'url' => 'nullable|string|max:255',
        'target' => 'nullable|string|max:10',
        'parent_id' => 'nullable|numeric',
        'order' => 'required|numeric',
        'route' => 'nullable|string|max:255',
    ];

    public function mount(Menu $id): void
    {
        $this->menu = $id;
    }

    public function render(): View
    {
        $this->content = MenuItem::with('children')
        ->where('menu_id', $this->menu->id)
        ->whereNull('parent_id')
        ->orderBy('order')->get();

        return view('component::livewire.menu-item.index')->layout('component::layouts.dashboard');
    }

    public function create(): void
    {
        $this->clearValue();
        $this->openEditWindow();

        $this->order = MenuItem::where('menu_id', $this->menu->id)->count() + 1;
    }

    public function edit(MenuItem $menuItem): void
    {
        $this->clearValue();

        $this->editId = $menuItem['id'];

        $this->title = $menuItem['title'];
        $this->url = $menuItem['url'];
        $this->target = $menuItem['target'];
        $this->parent_id = $menuItem['parent_id'];
        $this->order = $menuItem['order'];
        $this->route = $menuItem['route'];

        $this->openEditWindow();
    }

    public function update(): void
    {
        $this->validate();

        if (! empty($this->editId)) {
            //update
            $query = MenuItem::find($this->editId);
        } else {
            // create
            $query = new MenuItem;
            $query['menu_id'] = $this->menu->id;
        }

        $query['title'] = $this->title;
        $query['url'] = $this->url;

        if (! empty($this->target)) {
            $query['target'] = $this->target;
        }

        $query['parent_id'] = $this->parent_id;
        $query['order'] = $this->order;
        $query['route'] = $this->route;

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

    public function deleteEntry(MenuItem $menuItem): void
    {
        if ($menuItem->delete()) {
            // TODO: flash message
        }
        // TODO: flash message
    }

    public function reorder($orderedIds): void
    {
        foreach ($orderedIds as $element) {
            MenuItem::where('id', $element['value'])->update([
                'order' => $element['order'],
            ]);
        }
    }

    public function reorderChildes($orderedIds)
    {
        foreach ($orderedIds as $element) {
            if (count($element['items']) > 0) {
                foreach ($element['items'] as $item) {
                    MenuItem::where('id', $item['value'])
                    ->where('parent_id', $element['value'])
                    ->update([
                        'order' => $item['order'],
                    ]);
                }
            }
        }
    }

    private function clearValue(): void
    {
        $this->editId = null;

        $this->title = null;
        $this->url = null;
        $this->target = null;
        $this->parent_id = null;
        $this->order = null;
        $this->route = null;
    }
}
