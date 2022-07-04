<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Gauge extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $value;
    public $class;
    public $label;
    public function __construct($id, int $value, string $class = "", string $label = "")
    {
        $this->id = $id;
        $this->value = $value;
        $this->class = $class;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.gauge');
    }
}
