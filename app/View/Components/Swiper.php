<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Swiper extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $class;
    public $images;
    public $pagination;
    public function __construct(string $id, array|Collection $images, string $class = '', bool $pagination = false)
    {
        $this->id = $id;
        $this->class = $class;
        $this->images = $images;
        $this->pagination = $pagination;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.swiper');
    }
}
