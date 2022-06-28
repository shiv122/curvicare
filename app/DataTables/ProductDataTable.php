<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            ->editColumn('media', function ($data) {
                $images = $data->media->pluck('image')->toArray();
                if (empty($images)) {
                    return '<span class="badge badge-danger">No Image</span>';
                }
                return  view('content.table-component.avatar-group', compact('images'));
            })
            ->editColumn('url', function ($data) {
                return '<a href="' . $data->url . '" target="_blank">' . $data->url . '</a>';
            })
            ->editColumn('description', function ($data) {
                $title = "Description";
                $body = $data->description;
                $id = $data->id;
                return view('content.table-component.modal', compact('title', 'body', 'id'));
            })
            ->addColumn('status', function ($data) {
                $route = route('admin.product.status');
                return view('content.table-component.switch', compact('data', 'route'));
            })
            ->escapeColumns('url');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        $model->with(['media'])->newQuery();

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
            ->setTableId('product-table')
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
            Column::make('media')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('description')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),
            Column::make('name'),
            Column::make('url'),
            Column::make('status')
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
        return 'Product_' . date('YmdHis');
    }
}
