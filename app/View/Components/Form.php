<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public $id;
    public $class;
    public $method;
    public $route;
    public $btnText;
    public function __construct($id, $route, $class = "", $method = "POST",  $btnText = "Submit")
    {
        $this->id = $id;
        $this->class = $class;
        $this->method = $method;
        $this->route = $route;
        $this->btnText = $btnText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}
