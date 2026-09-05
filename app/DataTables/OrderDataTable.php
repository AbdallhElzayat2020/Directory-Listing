<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user_name', function ($order) {
                return $order->user->name;
            })
            ->addColumn('email', function ($order) {
                return $order->user->email;
            })
            ->addColumn('package', function ($order) {
                return $order->package->name;
            })
            ->addColumn('paid_amount', function ($order) {
                return $order->paid_amount . $order->base_currency;
            })
            ->addColumn('paid_currency', function ($order) {
                return $order->paid_currency;
            })
            ->addColumn('payment_method', function ($order) {
                return $order->payment_method;
            })
            ->addColumn('payment_status', function ($order) {
                return view('admin.order.datatable.payment_status', ['order' => $order]);
            })
            ->addColumn('created_at', function ($order) {
                return $order->created_at->format('d m Y');
//                return $order->created_at->diffForHumans();
            })
            ->addColumn('action', function ($order) {
                return view('admin.order.datatable.action', ['order' => $order]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
//        return $model->newQuery();
        return $model->newQuery()
            ->with([
                'user',
                'package',
            ]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id')->width(50),
            Column::make('user_name'),
            Column::make('email'),
            Column::make('package'),
            Column::make('paid_amount'),
            Column::make('paid_currency'),
            Column::make('payment_status'),
            Column::make('payment_method'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
