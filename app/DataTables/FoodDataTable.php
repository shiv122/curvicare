<?php

namespace App\DataTables;

use App\Models\Food;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FoodDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function ($data) {
                return  date("M jS, Y h:i A", strtotime($data->created_at));
            })
            ->addColumn('images', function ($data) {
                $images = $data->images->pluck('image')->toArray();
                if (empty($images)) {
                    return '<span class="badge badge-danger">No Image</span>';
                }
                return  view('content.table-component.avatar-group', compact('images'));
            })
            ->addColumn('description', function ($data) {
                $text = 'View';
                $class = 'btn btn-sm btn-primary data-viewer-btn';
                $prepend = '<span class=" d-none  data-viewer-content">' . $data->description . '</span>';
                return view('content.table-component.button', compact('text', 'class', 'prepend'));
            })
            ->addColumn('ingredients', function ($data) {
                $table = '<table class="table ">';
                $table .= '<thead><tr><th>Ingredient</th><th>Quantity</th><th>Unit</th></tr></thead>';
                foreach ($data->ingredients as $key => $value) {
                    $table .= '<tr><td>' . $value->name . '</td><td>' . $value->quantity->quantity . '</td><td>' . $value->quantity->unit . '</td></tr>';
                }
                $table .= '</table>';
                $text = 'View ingredients';
                $class = 'btn btn-sm btn-primary data-viewer-btn';
                $prepend = '<span class=" d-none  data-viewer-content">' . $table . '</span>';
                return view('content.table-component.button', compact('text', 'class', 'prepend'));
            })
            ->addColumn('status', function ($data) {
                $route = route('admin.package.status');
                return view('content.table-component.switch', compact('data', 'route'));
            })
            ->escapeColumns('images',);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Food $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Food $model)
    {
        $model = $model->with([
            'images:id,food_id,image',
            'ingredients:id,name'
        ])->newQuery();


        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('food-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->parameters([
                'scrollX' => true, 'paging' => true,
                'lengthMenu' => [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
            ])
            ->buttons(
                Button::make('csv'),
                Button::make('excel'),
                Button::make('print'),
                Button::make('pageLength'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('name'),
            Column::make('description')
                ->width('100')
                ->searchable(true)
                ->orderable(false)
                ->addClass('text-center'),
            Column::make('ingredients')
                ->data('ingredients')
                ->orderable(false)
                ->name('ingredients.name')
                ->addClass('text-center'),
            Column::make('images')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Food_' . date('YmdHis');
    }
}
