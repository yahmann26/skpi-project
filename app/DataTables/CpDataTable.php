<?php

namespace App\DataTables;

use App\Models\CapaianPembelajaran;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CpDataTable extends DataTable
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
            ->addColumn('prodi', function ($cp) {
                return $cp->prodi->nama_prodi; // Mengambil nama prodi dari relasi
            })
            ->addColumn('action', function($row){
                $editUrl = route('cp.edit', $row->id);
                $deleteUrl = route('cp.destroy', $row->id);
                return '
                    <a href="'.$editUrl.'" class="edit btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <form action="'.$deleteUrl.'" method="POST" style="display:inline-block;">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </form>';
            })
            ->editColumn('penguasaan_pengetahuan', function ($cp) {
                return strip_tags($cp->penguasaan_pengetahuan); // Menghilangkan HTML tag dari kolom sistem cp
            })
            ->editColumn('keterampilan', function ($cp) {
                return strip_tags($cp->keterampilan); // Menghilangkan HTML tag dari kolom kkni
            })
            ->editColumn('kemampuan_kerja', function ($cp) {
                return strip_tags($cp->kemampuan_kerja); // Menghilangkan HTML tag dari kolom sistem cp
            })
            ->editColumn('sikap', function ($cp) {
                return strip_tags($cp->sikap); // Menghilangkan HTML tag dari kolom kkni
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CapaianPembelajaran $model): QueryBuilder
    {
        return $model->newQuery()->with('prodi');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('cp-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
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
            Column::computed('DT_RowIndex')->title('No')->width(20)->addClass('text-center'),
            Column::make('prodi')->title('Prodi')->width(20),
            Column::make('penguasaan_pengetahuan')->width(25),
            Column::make('keterampilan')->width(25),
            Column::make('kemampuan_kerja')->width(25),
            Column::make('sikap')->width(25),
            Column::computed('action')
                //   ->exportable(false)
                //   ->printable(false)
                  ->width(20)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Cp_' . date('YmdHis');
    }
}
