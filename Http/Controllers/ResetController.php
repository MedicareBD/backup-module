<?php

namespace Modules\Backup\Http\Controllers;

use Artisan;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ResetController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:reset-read')->only('index');
        $this->middleware('permission:reset-update')->only('run');
    }

    public function index()
    {
        return view('backup::reset.index');
    }

    public function run()
    {
        Artisan::call('migrate:fresh --seed');
        Artisan::call('module:seed');
        Artisan::call('optimize:clear');

        return response()->json([
            'message' => __("System Successfully Reset"),
            'redirect' => route('admin.reset.index')
        ]);
    }
}
