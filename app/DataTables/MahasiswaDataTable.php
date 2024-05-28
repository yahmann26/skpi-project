<?php

namespace App\DataTables;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MahasiswaDataTable extends DataTable
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
        ->addColumn('prodi', function ($mahasiswa) {
            return $mahasiswa->prodi->nama_prodi; // Mengambil nama prodi dari relasi
        })
        ->addColumn('action', function ($row) {
            $showUrl = route('mahasiswa.show', $row->id);
            $editUrl = route('mahasiswa.edit', $row->id);
            $deleteUrl = route('mahasiswa.destroy', $row->id);
            return '
            <a href="' . $showUrl . '" class="edit btn btn-success btn-sm"><i class="bi bi-eye"></i></a>
            <a href="' . $editUrl . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
            <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                ' . csrf_field() . '
                ' . method_field("DELETE") . '
                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
            </form>';
        })
        ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Mahasiswa $model): QueryBuilder
    {
        return $model->newQuery()->with('prodi');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('mahasiswa-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(1, 'asc')
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
            Column::make('nim')->width(90),
            Column::make('nama_mahasiswa')->width(90),
            Column::make('prodi')->title('Prodi')->width(90),
            Column::make('tgl_masuk')->width(90),
            Column::computed('action')
                //   ->exportable(false)
                //   ->printable(false)
                  ->width(30)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Mahasiswa_' . date('YmdHis');
    }
}
