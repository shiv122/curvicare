<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $options;
    public $multiple;
    public $class;
    public $attrs;
    public $required;
    public function __construct($name, $options = [], $multiple = false, $class = "", $attrs = "", $required = true)
    {
        $this->name = $name;
        $this->options = $options;
        $this->multiple = $multiple;
        $this->class = $class;
        $this->attrs = $attrs;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
