<?php

namespace App\DataTables;

use App\Models\Mascota;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MascotaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'mascotas.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Mascota $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Mascota $model)
    {
        return $model->newQuery()->with(['propietario', 'sexo', 'razas']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'nombre',
            'fecha_nac',
            'Color',
            /*'cod_propietario',
            'cod_sexo',
            'cod_raza',*/
            'propietario' => new \Yajra\DataTables\Html\Column(['title' => 'Propietario', 'data' => 'propietario.nombres', 'name' => 'propietario.nombres']),
            'sexo' => new \Yajra\DataTables\Html\Column(['title' => 'Sexo', 'data' => 'sexo.sexo', 'name' => 'sexo.sexo']),
            'raza' => new \Yajra\DataTables\Html\Column(['title' => 'Raza', 'data' => 'razas.raza', 'name' => 'sexo.sexo'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'mascotasdatatable_' . time();
    }
}
