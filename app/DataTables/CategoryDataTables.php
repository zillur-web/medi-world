<?php

namespace App\DataTables;

use App\Helpers\Traits\RowIndex;
use App\Models\Categroy;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTables extends DataTable
{
    use RowIndex;
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('sl', function ($row) {
            // return $this->dt_index($row);
            return $row->id;
        })
        ->addColumn('category_name', function ($row) {
            return $row->category_name;
        })
        ->addColumn('image', function ($row) {
            if($row->image != null){
                $img = asset('uploads/category/'.$row->image);
            }
            else{
                $img = asset('uploads/category/'.$row->image);
            }
            $html = '<div class="text-center" uk-lightbox><a href="'.$img.'">
                <img style="width: 70px; border: 1px solid #ddd; border-radius: 4px; padding: 1px;" src="'. $img .'" alt="">
            </a></div>';
            return $html;
        })
        ->addColumn('action', function ($row) {
            return 'action';
        })
        ->rawColumns(['action', 'category_name', 'image', 'sl'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Categroy $model): QueryBuilder
    {
        if (request()->ajax()) {
            return $model->newQuery();
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('categorydatatables-table')
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
            Column::make('sl'),
            Column::make('category_name'),
            Column::make('image'),
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
        return 'CategoryDataTables_' . date('YmdHis');
    }
}
