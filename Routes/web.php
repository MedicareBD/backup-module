<?php

use Modules\Backup\Http\Controllers\BackupController;
use Modules\Backup\Http\Controllers\ResetController;
use Modules\Backup\Http\Controllers\RestoreController;
use Modules\Backup\Http\Controllers\SettingController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function (){
    Route::group(['prefix' => 'backup', 'as' => 'backup.'], function (){
        Route::resource('settings', SettingController::class)->only('index', 'update');
    });
    Route::resource('backup', BackupController::class)->except('update', 'edit');
    Route::get('reset', [ResetController::class, 'index'])->name('reset.index');
    Route::post('reset/run', [ResetController::class, 'run'])->name('reset.run');
    Route::get('restore', [RestoreController::class, 'index'])->name('restore.index');
    Route::post('restore/database', [RestoreController::class, 'databaseRestore'])->name('restore.database-restore');
});
