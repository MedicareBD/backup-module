<?php

namespace Modules\Backup\Listeners;

use Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Backup\Entities\Backup;
use Spatie\Backup\Events\BackupWasSuccessful;

class BackupWasSuccessfulListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function handle(BackupWasSuccessful $backupWasSuccessful)
    {
        if (!Auth::check()){
            $folder = $backupWasSuccessful->backupDestination->backupName();
            $filePath = $backupWasSuccessful->backupDestination->backups()->collect()->first()->path();

            Backup::create([
                'file_name' => str($filePath)->remove($folder.'/'),
                'folder' => $folder,
                'driver' => setting('backup.disk') ?? config('backup.backup.destination.disks'),
                'type' => 'full_backup',
                'from' => 'system'
            ]);
        }
    }
}
