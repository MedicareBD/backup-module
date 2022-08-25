<?php

namespace Modules\Backup\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SettingSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $settings = [
            ['key' => 'backup.send_notification_to', 'value' => 'your@example.com', 'lang' => 'en'],
            ['key' => 'backup.auto_backup', 'value' => 'daily', 'lang' => 'en'],
            ['key' => 'backup.slack_webhook_url', 'value' => 'https://example.com/example', 'lang' => 'en'],
            ['key' => 'backup.slack_channel', 'value' => 'example', 'lang' => 'en'],
            ['key' => 'backup.slack_username', 'value' => 'example', 'lang' => 'en'],
            ['key' => 'backup.slack_icon', 'value' => 'example', 'lang' => 'en'],
            ['key' => 'backup.discord_webhook_url', 'value' => 'https://example.com/example', 'lang' => 'en'],
            ['key' => 'backup.discord_username', 'value' => 'example', 'lang' => 'en'],
            ['key' => 'backup.discord_avatar_url', 'value' => 'https://example.com/example', 'lang' => 'en'],
            ['key' => 'backup.disks.0', 'value' => 'local', 'lang' => 'en'],
        ];

        \DB::table('settings')->insert($settings);
    }
}
