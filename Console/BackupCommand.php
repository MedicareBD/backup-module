<?php

namespace Modules\Backup\Console;

use Illuminate\Console\Command;

class BackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'backup:take';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the backup with custom settings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Config::set('app.locale', 'en');
        $sendToEmail = setting('backup.send_notification_to');
        $autoBackup = setting('backup.auto_backup');
        $password = setting('backup.password');
        $slackWebhookUrl = setting('backup.slack_webhook_url');
        $slackChannel = setting('backup.slack_channel');
        $slackUsername = setting('backup.slack_username');
        $slackIcon = setting('backup.slack_icon');
        $discordWebhookUrl = setting('backup.discord_webhook_url');
        $discordUsername = setting('backup.discord_username');
        $discordAvatar = setting('backup.discord_avatar_url');
        $disks = setting('backup.disks', ['local']);

        \Config::set([
            'backup.notifications.mail.to' => $sendToEmail,
            'backup.backup.password' => $password,
            'backup.notifications.slack.webhook_url' => $slackWebhookUrl,
            'backup.notifications.slack.channel' => $slackChannel,
            'backup.notifications.slack.username' => $slackUsername,
            'backup.notifications.slack.icon' => $slackIcon,
            'backup.notifications.discord.webhook_url' => $discordWebhookUrl,
            'backup.notifications.discord.username' => $discordUsername,
            'backup.notifications.discord.avatar_url' => $discordAvatar,
            'backup.backup.destination.disks' => $disks,
        ]);

        \Artisan::call('backup:run');
    }
}
