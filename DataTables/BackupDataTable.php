<?php

namespace Modules\Backup\DataTables;

use Modules\Backup\Entities\Backup;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BackupDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('type', fn($model) => ucwords(str($model->type)->replace('_', ' ')))
            ->editColumn('driver', fn($model) => collect($model->driver)->implode(','))
            ->editColumn('from', fn($model) => str($model->from)->upper())
            ->editColumn('by', fn($model) => $model->by->name ?? null)
            ->editColumn('download', 'backup::backup.download')
            ->editColumn('created_at', fn($model) => format_date($model->created_at, 'd M, Y h:i A'))
            ->addColumn('action', 'backup::backup.action')
            ->setRowId('id')
            ->rawColumns(['download', 'action']);
    }

    public function query(Backup $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('backup-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom(config('custom.table.dom'))
            ->orderBy(7)
            ->stateSave()
            ->autoWidth()
            ->responsive()
            ->addTableClass(config('custom.table.class'))
            ->parameters([
                'scrollY' => true,
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')
                ->data('DT_RowIndex')
                ->printable(false)
                ->exportable(false)
                ->orderable(false)
                ->title('#'),
            Column::make('file_name')->title(__("File Name")),
            Column::make('type')->title(__("Backup Type"))->addClass('text-center'),
            Column::make('driver')->title(__("Disk"))->addClass('text-center'),
            Column::make('from')->title(__("Created From"))->addClass('text-center'),
            Column::make('by')->title(__("Created By"))->addClass('text-center'),
            Column::make('download')->title(__("Download"))
                ->printable(false)
                ->exportable(false)
                ->orderable(false)
                ->addClass('text-center'),
            Column::make('created_at')->title(__("Created At")),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Action'),
        ];
    }

    protected function filename(): string
    {
        return 'Backup_' . date('YmdHis');
    }
}
