<?php

namespace Reinholdjesse\Components\Livewire\Menu;

use Livewire\Component;
use Reinholdjesse\Components\Helpers\addLivewireControlleFunctions;
use Reinholdjesse\Components\Models\Menu;

class Index extends Component
{

    use addLivewireControlleFunctions;

    public $name = null;

    public $content;

    public $openEdit = false;

    public $editId = null;

    public function render()
    {
        $this->content = Menu::all();

        return view('component::livewire.menu.index')->layout('component::layouts.dashboard');
    }

    public function edit(Menu $menu)
    {
        $this->clearValue();

        $this->editId = $menu->id;
        $this->name = $menu->name;

        $this->openEditWindow();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:3',
        ]);

        if (!empty($this->editId)) {
            //update
            $query = Menu::find($this->editId);
        } else {
            // create
            $query = new Menu;
        }

        $query->name = $this->name;

        $this->cloasEditWindow();
        $this->clearValue();

        if ($query->save()) {
            // TODO: flash message
            $this->bannerMessage('success', 'Menu wurde erfolgreich erstellt.');
        } else {
            // TODO: flash message
            $this->bannerMessage('success', 'Menu wurde erfolgreich aktualisiert.');
        }
    }

    public function deleteEntry(Menu $menu)
    {
        if ($menu->delete()) {
            // TODO: flash message
        } else {
            // TODO: flash message
        }
    }

    private function clearValue()
    {
        $this->editId = null;
        $this->name = null;
    }

}
