<?php

namespace Modules\Backup\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backup\Http\Requests\DatabaseRestoreRequest;

class RestoreController extends Controller
{
    public function index()
    {
        return view('backup::restore.index');
    }

    public function databaseRestore(DatabaseRestoreRequest $request)
    {
        $type = $request->file('database')->getClientMimeType();
        if ($type !== 'application/sql'){
            return response()->json([
                'errors' => [
                    'database' => __("The database must be a file of type: application/sql.")
                ],
                'message' => __("The database must be a file of type: application/sql.")
            ], 422);
        }

        \Artisan::call('db:wipe --force');

        \DB::unprepared(file_get_contents($request->file('database')));

        return response()->json([
            'message' => __("Database Restored Successfully"),
            'redirect' => route('admin.restore.index')
        ]);
    }
}
