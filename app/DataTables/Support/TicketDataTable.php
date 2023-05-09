<?php

namespace App\DataTables\Support;

use App\Models\Ticket;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TicketDataTable extends DataTable
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

            ->editColumn('question', function ($data) {
                return '<span style="width: 30rem;display:block;white-space: break-spaces;">' . $data->question->question . '</span>';
            })
            ->editColumn('description', function ($data) {
                return '<span style="width: 30rem;display:block;white-space: break-spaces;">' . $data->description . '</span>';
            })

            ->editColumn('reply', function ($data) {

                if ($data->reply) {
                    return '<span style="width: 30rem;display:block;white-space: break-spaces;">' . $data->reply . '</span>';;
                }

                return '<button class="btn btn-flat-info" data-reply="' . htmlentities(json_encode($data)) . '">Reply</button>';
            })

            ->escapeColumns('created_at');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Ticket $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ticket $model)
    {
        $model =  $model->newQuery();

        $model->with([
            'user:id,name,email',
            'question'
        ]);

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
            ->setTableId('ticket-table')
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
            Column::make('ticket_no'),
            Column::make('user.name')
                ->title('User'),
            Column::make('question')
                ->title('Ticket Question'),
            Column::make('description')
                ->title('User Question'),

            Column::computed('reply')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('created_at'),
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
        return 'Ticket._' . date('YmdHis');
    }
}
