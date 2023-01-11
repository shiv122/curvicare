<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tab extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $class;
    public $innerClass;
    public $tabs;
    public $active;
    public $id;

    public function __construct(
        array $tabs,
        string $active,
        $class = 'col-md-12',
        $innerClass = 'nav-fill',
        $id = null,

    ) {
        $this->class = $class;
        $this->innerClass = $innerClass;
        $this->tabs = $tabs;
        $this->active = $active;
        $this->id = $id ?? 'tab-' . uniqid();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tab');
    }
}
