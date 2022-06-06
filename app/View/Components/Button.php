<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public  $class;
    public $type;
    public $text;
    public $icon;
    public $isSubmit;
    public $attrs;
    public function __construct($class = "", $type = "primary", $text = "", $isSubmit = false, $icon = "", $attrs = "")
    {
        $this->class = $class;
        $this->type = $type;
        $this->text = $text;
        $this->isSubmit = $isSubmit;
        $this->icon = $icon;
        $this->attrs = $attrs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
