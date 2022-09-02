<?php

namespace Reinholdjesse\Components\View\Components\Element;

use Illuminate\View\Component;

class DropFile extends Component
{
    /** @var int */
    public $id;
    /** @var string */
    public $name;
    /** @var bool */
    public $multiple;
    /** @var string|null */
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, bool $multiple = false, $title = null)
    {
        $this->id = uniqid();
        $this->name = $name;
        $this->multiple = $multiple;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('component::components.element.drop-file');
    }
}
