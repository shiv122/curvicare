<?php

namespace App\DataTables\Support;

use App\Models\TicketQuestion;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TicketQuestionDataTable extends DataTable
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
            ->addColumn('action', function ($value) {
                $edit_route = route('admin.ticket.question.edit', $value->id);
                $edit_callback = 'setValue';
                $modal = '#edit-ticket-question-modal';
                return view('content.table-component.action', compact('edit_route', 'edit_callback', 'modal'));
            })
            ->editColumn('created_at', function ($data) {
                return  '<span class="badge badge-primary">' . date("M jS, Y h:i A", strtotime($data->created_at)) . '</span>';
            })
            ->addColumn('status', function ($data) {
                $route = route('admin.ticket.question.status');
                return view('content.table-component.switch', compact('data', 'route'));
            })
            ->editColumn('question', function ($data) {
                return '<span style="max-width: 100px;white-space: break-spaces;">' . $data->question . '</span>';
            })
            ->escapeColumns('created_at', 'action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TicketQuestion $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TicketQuestion $model)
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
            ->setTableId('ticket-question-table')
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

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'TicketQuestion._' . date('YmdHis');
    }
}
