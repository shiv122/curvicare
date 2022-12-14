<?php

namespace App\DataTables;

use App\Models\Faq;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FaqDataTable extends DataTable
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
            ->addColumn('status', function ($data) {
                $route = route('admin.faq.status');
                return view('content.table-component.switch', compact('data', 'route'));
            })
            ->addColumn('is_paid', function ($data) {
                $route = route('admin.faq.status.is_paid');
                $column = 'is_paid';
                $checked_value = 'yes';
                return view('content.table-component.switch', compact('data', 'route', 'column', 'checked_value'));
            })
            ->addColumn('is_featured', function ($data) {
                $route = route('admin.faq.status.is_featured');
                $column = 'is_featured';
                $checked_value = 'yes';
                return view('content.table-component.switch', compact('data', 'route', 'column', 'checked_value'));
            })

            ->editColumn('action', function ($data) {
                $route = route('admin.faq.edit', $data->id);
                return '<button data-edit="' . $route . '" class="btn btn-primary btn-sm edit-faq" data-modal="#edit-faq-modal" data-callback="setValue">Edit</button>';
            })

            ->escapeColumns('created_at', 'action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Faq $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Faq $model)
    {
        $model =  $model->newQuery()
            ->with(['faq_category']);

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
            ->setTableId('faq-table')
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
            Column::make('question'),
            Column::make('answer')
                ->class('w-space-line'),
            Column::make('faq_category.name')
                ->title('Category'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('is_paid')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('is_featured')
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
        return 'Faq._' . date('YmdHis');
    }
}
