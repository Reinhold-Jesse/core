<?php

namespace App\View\Components\Element;

use Illuminate\View\Component;

class Datepicker extends Component
{
    public $model;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $model = NULL)
    {
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.datepicker');
    }
}
