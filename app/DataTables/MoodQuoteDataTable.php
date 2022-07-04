<?php

namespace App\DataTables;

use App\Models\MoodQuote;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MoodQuoteDataTable extends DataTable
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
                return  view('content.table-component.avatar', compact('image'));
            })
            ->editColumn('mood', function ($data) {
                return '<span class="badge badge-success">' . $data->mood->name . '</span>';
            })

            ->escapeColumns('moods');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MoodQuote $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MoodQuote $model)
    {
        $model =   $model->newQuery();
        if ($this->id) {
            $model =  $model->where('id', $this->id);
        }
        $model->with(['mood']);
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
            ->setTableId('quote-table')
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
            Column::make('quotes'),
            Column::make('mood')
                ->orderable(false),
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
        return 'Quote_' . date('YmdHis');
    }
}
