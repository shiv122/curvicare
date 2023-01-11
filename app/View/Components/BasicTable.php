<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BasicTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $tableId;
    public $tableTitle;
    public $headers;
    public $rows;
    public $class;
    public function __construct(
        string $tableId,
        array $headers,
        array $rows,
        string $tableTitle = "",
        string $class = "",
    ) {
        $this->tableId = $tableId;
        $this->tableTitle = $tableTitle;
        $this->headers = $headers;
        $this->rows = $rows;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.basic-table');
    }
}
