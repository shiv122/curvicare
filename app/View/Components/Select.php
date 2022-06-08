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
    public $additionalOptionText;
    public function __construct(string $name, array|object $options = [], bool $multiple = false, string $class = "", $attrs = "", bool $required = true, array $additionalOptionText = [])
    {
        $this->name = $name;
        $this->options = $options;
        $this->multiple = $multiple;
        $this->class = $class;
        $this->attrs = $attrs;
        $this->required = $required;
        $this->additionalOptionText = $additionalOptionText;
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
