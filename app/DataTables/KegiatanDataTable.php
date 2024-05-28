<?php

namespace App\DataTables;

use App\Models\Kegiatan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class KegiatanDataTable extends DataTable
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
        ->addColumn('kategori', fn($kegiatan) => $kegiatan->kategori->nama_kategori)
        ->addColumn('action', fn($row) => $this->actionColumn($row))
            ->rawColumns(['action']);
    }

    private function actionColumn($row): string
    {
        // $showUrl = route('kegiatan.show', ['id' => $row->id]);
        $editUrl = route('kegiatan.edit', ['id' => $row->id]);
        $deleteUrl = route('kegiatan.destroy', ['id' => $row->id]);

        return view('partials.action_buttons', compact('showUrl', 'editUrl', 'deleteUrl'))->render();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Kegiatan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('kegiatan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('No')->width(10)->addClass('text-center'),
            Column::make('nama_kegiatan')->width(90),
            Column::make('kategori')->title('Kategori')->width(50),
            Column::make('tingkat_kegiatan')->width(50),
            Column::make('jabatan')->width(30),
            Column::make('bobot')->width(30),
            Column::computed('action')
                  ->width(30)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Kegiatan_' . date('YmdHis');
    }
}
