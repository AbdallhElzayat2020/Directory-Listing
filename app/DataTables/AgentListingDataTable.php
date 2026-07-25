<?php

namespace App\DataTables;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AgentListingDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('Category', function (Listing $listing) {
                return $listing->category->title;
            })
            ->addColumn('Location', function (Listing $listing) {
                return $listing->location->title;
            })
            ->addColumn('status', function (Listing $listing) {
                return view('frontend.dashboard.listings.datatable.status', ['listing' => $listing]);
            })
            ->addColumn('Approved', function (Listing $listing) {
                return view('frontend.dashboard.listings.datatable.is_approved', ['listing' => $listing]);
            })
            ->addColumn('Verified', function (Listing $listing) {
                return view('frontend.dashboard.listings.datatable.is_verified', ['listing' => $listing]);
            })
            ->addColumn('action', function (Listing $listing) {
                return view('frontend.dashboard.listings.datatable.action', ['listing' => $listing]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Listing $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('user_id', auth()->id())
            ->with(['category', 'location']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('agentlisting-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
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
            Column::make('title'),
            Column::make('Category'),
            Column::make('Location'),
            Column::make('status'),
            Column::make('Verified'),
            Column::make('Approved'),
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
        return 'AgentListing_' . date('YmdHis');
    }
}
