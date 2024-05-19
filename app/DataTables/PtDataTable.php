<?php

namespace App\DataTables;

use App\Models\Pt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PtDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('pt.edit', $row->id);
                $deleteUrl = route('pt.destroy', $row->id);
                return '
                <a href="' . $editUrl . '" class="edit btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </form>';
            })
            ->editColumn('sistem_pt', function ($pt) {
                return strip_tags($pt->sistem_pt); // Menghilangkan HTML tag dari kolom sistem pt
            })
            ->editColumn('kkni', function ($pt) {
                return strip_tags($pt->kkni); // Menghilangkan HTML tag dari kolom kkni
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pt $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pt-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1, 'asc')
            ->selectStyleSingle()
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('No')->width(40)->addClass('text-center'),
            Column::make('sistem_pt'),
            Column::make('kkni'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pt_' . date('YmdHis');
    }
}
