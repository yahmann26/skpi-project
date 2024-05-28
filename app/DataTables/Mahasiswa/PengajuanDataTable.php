<?php

namespace App\DataTables\Mahasiswa;

use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PengajuanDataTable extends DataTable
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
        ->addColumn('kegiatan', function ($pengajuan) {
            return $pengajuan->kegiatan->nama_kegiatan; // Mengambil nama kegiatan dari relasi
        })
        ->addColumn('kategori', function ($pengajuan) {
            return $pengajuan->kegiatan->kategori->nama_kategori; // Mengambil nama kategori dari relasi
        })
        ->addColumn('action', function ($row) {
            $showUrl = route('pengajuan.show', $row->id);
            $editUrl = route('pengajuan.edit', $row->id);
            $deleteUrl = route('pengajuan.destroy', $row->id);
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
    public function query(Pengajuan $model): QueryBuilder
    {
        return $model->newQuery()->with('kegiatan');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pengajuan-table')
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
            Column::computed('DT_RowIndex')->title('No')->width(10)->addClass('text-center'),
            Column::make('kategori')->width(90),
            Column::make('kegiatan')->width(90),
            // Column::make('tingkat_kegiatan')->width(50),
            // Column::make('jabatan')->width(30),
            // Column::make('bobot')->width(30),
            Column::make('status')->width(30),
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
        return 'Pengajuan_' . date('YmdHis');
    }
}
