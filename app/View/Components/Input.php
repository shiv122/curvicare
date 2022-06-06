<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $class;
    public $name;
    public $type;
    public $hasLabel;
    public $attrs;
    public $parentClass;
    public $helperText;
    public $value;
    public $required;
    public function __construct($class = "", $name = "", $type = "text", $hasLabel = true, $attrs = "", $parentClass = "", $helperText = "", $value = "", $required = true)
    {
        $this->class = $class;
        $this->name = $name;
        $this->type = $type;
        $this->hasLabel = $hasLabel;
        $this->attrs = $attrs;
        $this->parentClass = $parentClass;
        $this->helperText = $helperText;
        $this->value = $value;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
