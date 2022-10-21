<?php

namespace App\DataTables;

use App\Models\Recipe;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RecipeDataTable extends DataTable
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
            ->editColumn('image', function ($data) {
                $image = $data->image;
                if (empty($image)) {
                    return '<span class="badge badge-danger">No Image</span>';
                }
                return  view('content.table-component.avatar', compact('image'));
            })
            ->addColumn('status', function ($data) {
                $route = route('admin.recipe.status');
                return view('content.table-component.switch', compact('data', 'route'));
            })
            ->addColumn('view', function ($data) {
                return '<a target="_blank" href="' . route('admin.recipe.show', $data->id) . '" class="btn btn-primary btn-sm">View</a>';
            })

            ->editColumn('is_paid', function ($data) {
                $route = route('admin.recipe.paid-status');
                $column = 'is_paid';
                $checked_value = 'yes';
                return view('content.table-component.switch', compact('data', 'column', 'route', 'checked_value'));
            })

            ->escapeColumns('view');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Recipe $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Recipe $model)
    {
        $model =   $model->newQuery();
        if ($this->id) {
            $model->where('id', $this->id);
        }
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
            ->setTableId('recipe-table')
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
            Column::make('image')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('view')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('status')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('is_paid'),
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
        return 'Recipe_' . date('YmdHis');
    }
}
