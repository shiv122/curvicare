<?php

namespace App\DataTables;

use App\Models\Expertise;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpertiseDataTable extends DataTable
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
                return  '<span class="badge badge-primary">' . date("M jS, Y h:i A", strtotime($data->created_at)) . '</span>';
            })

            ->addColumn('action', function ($data) {

                $edit_route = route('admin.metadata.expertise.edit', $data->id);
                $edit_callback = 'setValue';
                $modal = '#edit-expertise-modal';
                $delete_route = route('admin.metadata.expertise.destroy', $data->id);
                return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
            })

            ->editColumn('icon', function ($data) {
                $image = $data->icon;

                if (!$image) {
                    return '<span class="badge badge-light-danger">No Icon</span>';
                }

                return  view('content.table-component.avatar', compact('image'));
            })
            ->escapeColumns('created_at');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Expertise $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Expertise $model)
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
            ->setTableId('expertise-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->searchDelay(1000)
            ->parameters([
                'scrollX' => true, 'paging' => true,
                'searchDelay' => 350,
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
            Column::make('icon'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
        return 'Expertise._' . date('YmdHis');
    }
}
