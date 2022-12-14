<?php
namespace Reinholdjesse\Core\Traits;

trait addLivewireControlleFunctions
{

    public function updatingSearch()
    {
        $this->resetPage();
    }

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

    public function filter(string $key, string $type)
    {
        $this->filter[$key] = $type;
    }

    public function removeFilterType(string $key)
    {
        unset($this->filter[$key]);
    }

    public function bannerMessage(string $type, string $message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => $type,
            'message' => $message,
        ]);
    }
    public function storeAndIndex()
    {
        $this->store();
        $this->bannerMessage('success', 'Eintrag wurde erfolgreich erstellt');
        return redirect()->route($this->routeIndex);
    }

    public function storeAndNew()
    {
        $this->store();
        $this->bannerMessage('success', 'Eintrag wurde erfolgreich erstellt');
        return redirect()->route($this->isRoute);
    }

    public function updateAndIndex()
    {
        $this->update();
        return redirect()->route($this->routeIndex);
    }

    public function updateAndNew()
    {
        $this->update();
        return redirect()->route($this->isRoute);
    }

    public function cancel()
    {
        return redirect()->route($this->routeIndex);
    }

}
