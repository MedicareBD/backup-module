<?php

namespace Modules\Backup\Http\Controllers;

use Artisan;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backup\DataTables\BackupDataTable;
use Modules\Backup\Entities\Backup;
use Modules\Backup\Http\Requests\StoreBackupRequest;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:backup-create')->only('create', 'store');
        $this->middleware('permission:backup-read')->only('index', 'store');
    }

    public function index(BackupDataTable $dataTable)
    {
        return $dataTable->render('backup::backup.index');
    }

    public function create()
    {
        return view('backup::.backup.create');
    }

    public function store(StoreBackupRequest $request)
    {
        $validated = $request->validated();
        $filename = $validated['name'].'_'.now()->format('Y-m-d-h-i-A').'.zip';

        try {
            if ($validated['backup_type'] == 'only_db'){
                Artisan::call('backup:run --only-db --filename='.$filename);
            }elseif($validated['backup_type'] == 'only_files'){
                Artisan::call('backup:run --only-files --filename='.$filename);
            }else{
                Artisan::call('backup:run --filename='.$filename);
            }

            Backup::create([
                'file_name' => $filename,
                'folder' => config('backup.backup.name'),
                'file_path' => config('backup.backup.name').'/'.$filename,
                'driver' => config('backup.backup.destination.disks'),
                'type' => $validated['backup_type'],
                'from' => 'ui',
                'by' => user()->id
            ]);

            return response()->json([
                'message' => __('Backup Created Successfully'),
                'redirect' => route('admin.backup.index')
            ]);
        }catch (\Throwable $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500);
        }
    }

    public function show(Backup $backup)
    {
        foreach ($backup->driver as $driver) {
            if (\Storage::disk($driver)->exists($backup->folder.'/'.$backup->file_name)){
                return \Storage::disk($driver)->download($backup->folder.'/'.$backup->file_name);
            }
        }
    }

    public function destroy(Backup $backup)
    {
        foreach ($backup->driver as $driver) {
            if (\Storage::disk($driver)->exists($backup->folder.'/'.$backup->file_name)){
                \Storage::disk($driver)->delete($backup->folder.'/'.$backup->file_name);
            }
        }

        $backup->delete();

        return response()->json([
            'message' => __('Backup Deleted Successfully'),
        ]);
    }
}
