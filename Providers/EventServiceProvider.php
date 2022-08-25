<?php

namespace Modules\Backup\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Backup\Listeners\BackupWasSuccessfulListener;
use Spatie\Backup\Events\BackupWasSuccessful;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BackupWasSuccessful::class => [
            BackupWasSuccessfulListener::class,
        ],
    ];
}
