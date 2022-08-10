<?php

namespace App\DataTables;

use App\Models\Mood;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MoodDataTable extends DataTable
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
            ->addColumn('status', function ($data) {
                $route = route('admin.metadata.mood.status');
                return view('content.table-component.switch', compact('data', 'route'));
            })
            ->addColumn('action', function ($value) {
                $edit_route = route('admin.metadata.mood.edit', $value->id);
                $edit_callback = 'setValue';
                $modal = '#edit-mood-modal';
                $delete_route = route('admin.metadata.mood.destroy', $value->id);
                return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
            })
            ->escapeColumns('action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Mood $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Mood $model)
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
            ->setTableId('mood-table')
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
            Column::make('status')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('created_at'),
            Column::make('action')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Mood_' . date('YmdHis');
    }
}
