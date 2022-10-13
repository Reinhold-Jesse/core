<?php

namespace Reinholdjesse\Core\Traits;

trait AddLivewireStoreUpdateTraits
{

    public function storeAndIndex()
    {
        $this->store();
        return redirect()->route($this->routeIndex);
    }

    public function storeAndNew()
    {
        $this->store();
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
