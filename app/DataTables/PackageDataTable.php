<?php

namespace App\DataTables;

use App\Models\Package;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PackageDataTable extends DataTable
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
            ->editColumn('duration', function ($data) {
                return  $data->duration . " days";
            })
            ->addColumn('status', function ($data) {
                $route = route('admin.package.status');
                return view('content.table-component.switch', compact('data', 'route'));
            })
            ->addColumn('coupons', function ($data) {
                $coupons = $data->coupons;
                $coupon_badge = '';
                if (count($coupons) > 0) {
                    foreach ($coupons as $coupon) {
                        $coupon_badge .= '<span
                         class="badge badge-light-success ml-1">' . $coupon->coupon->code . '</span>';
                    }
                } else {
                    $coupon_badge .= '<span class="badge badge-light-danger">No Coupon</span>';
                }
                return $coupon_badge;
            })
            ->addColumn('view', function ($data) {
                $route = route('admin.package.show', $data->id);
                return '<a href="' . $route . '" class="btn btn-sm btn-primary">View</a>';
            })
            ->escapeColumns('coupons');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Package $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Package $model)
    {
        $model =   $model->newQuery();
        $model->with(['prices', 'coupons.coupon', 'features']);
        if ($this->id) {
            $model =  $model->where('id', $this->id);
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
            ->setTableId('package-table')
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
            Column::make('title'),
            Column::make('duration'),
            Column::make('coupons'),
            Column::make('view')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),
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
        return 'Package_' . date('YmdHis');
    }
}
