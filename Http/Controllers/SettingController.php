<?php

namespace Modules\Backup\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Backup\Http\Requests\UpdateBackupSettingRequest;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:backup-setting-read')->only('index');
        $this->middleware('permission:backup-setting-update')->only('update');
    }

    public function index()
    {
        $oldLocale = app()->getLocale();
        app()->setLocale('en');
        $backup = setting('backup');
        app()->setLocale($oldLocale);

        return view('backup::setting.index', compact('backup'));
    }

    public function update(UpdateBackupSettingRequest $request)
    {
        foreach ($request->validated() as $key => $value) {
            \Setting::set('backup.'.$key, $value);
            \Setting::save();
        }

        return response()->json([
            'message' => __('Backup Setting Saved Successfully'),
            'redirect' => route('admin.backup.settings.index'),
        ]);
    }
}
