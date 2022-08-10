<?php

namespace App\DataTables;

use App\Models\Ingredient;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class IngredientDataTable extends DataTable
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
                return  '<span class="badge badge-light-success">' . date("M jS, Y h:i A", strtotime($data->created_at)) . '</span>';
            })
            ->editColumn('image', function ($data) {
                $image = $data->image;
                return  view('content.table-component.avatar', compact('image'));
            })
            ->addColumn('status', function ($data) {
                $route = route('admin.package.status');
                return view('content.table-component.switch', compact('data', 'route'));
            })
            ->escapeColumns('created_at');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Ingredients $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ingredient $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('ingredient-table')
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
            Column::make('image')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('name'),
            Column::make('created_at'),
            Column::make('status')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Ingredient_' . date('YmdHis');
    }
}
