<?php

namespace Reinholdjesse\Components\Livewire\MenuItem;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('component::livewire.menu-item.edit')->layout('component::layouts.dashboard');
    }
}
