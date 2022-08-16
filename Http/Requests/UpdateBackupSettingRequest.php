<?php

namespace Modules\Backup\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBackupSettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'send_notification_to' => ['nullable', 'email', 'max:255'],
            'auto_backup' => ['nullable', Rule::in(['off', 'daily', 'weekly', 'monthly', 'yearly'])],
            'password' => ['nullable', 'string', 'max:255'],
            'disks' => ['nullable', 'array'],
            'disks.*' => ['nullable', Rule::in(['local','public','s3'])],

            // Slack
            'slack_webhook_url' => ['nullable', 'url'],
            'slack_channel' => ['nullable', 'string', 'max:255'],
            'slack_username' => ['nullable', 'string', 'max:255'],
            'slack_icon' => ['nullable', 'string', 'max:255'],

            // Discord
            'discord_webhook_url' => ['nullable', 'url'],
            'discord_username' => ['nullable', 'string', 'max:255'],
            'discord_avatar_url' => ['nullable', 'url'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
