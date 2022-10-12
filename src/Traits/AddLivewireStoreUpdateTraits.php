<?php

namespace Reinholdjesse\Core\Traits;

trait AddLivewireStoreUpdateTraits
{

    public function storeAndIndex()
    {
        dd('store and redirect to index');
    }

    public function storeAndNew()
    {
        dd('store and new');
        $this->store();

        return redirect()->back();
    }

    public function updateAndIndex()
    {
        dd('update and redirect to index');
    }

    public function updateAndNew()
    {
        dd('update and new');
        $this->update();

        return redirect()->back();
    }
}
