<?php
namespace Reinholdjesse\Core\Helpers;

trait addLivewireControlleFunctions
{

    public function openEditWindow()
    {
        $this->openEdit = true;
    }

    public function cloasEditWindow()
    {
        $this->openEdit = false;
    }

    public function create()
    {
        $this->clearValue();
        $this->openEditWindow();
    }

    public function bannerMessage(string $type, string $message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => $type,
            'message' => $message,
        ]);
    }

}
