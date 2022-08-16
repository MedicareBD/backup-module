@extends('core::layouts.admin.app')

@section('title', __('Backup Settings'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>@lang('Backup Settings')</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.backup.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> @lang('Create Backup')
                        </a>
                        <a href="{{ route('admin.backup.index') }}" class="btn btn-primary">
                            <i class="fas fa-hdd"></i> @lang('Backup Lists')
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.backup.settings.update', 'update') }}" method="post" class="instant_reload_form">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="send_notification_to">{{ __("Send Notification To") }}</label>
                            <input type="email" name="send_notification_to" id="send_notification_to" class="form-control"
                                   value="{{ $backup['send_notification_to'] ?? config('backup.notifications.mail.to') }}" placeholder="{{ __('Enter email') }}">
                        </div>

                        <div class="form-group">
                            <label for="auto_backup">{{ __("Auto Backup") }}</label>
                            <select name="auto_backup" id="auto_backup" data-control="select2" data-placeholder="{{ __('Select auto backup period') }}">
                                <option></option>
                                @php
                                    $autoBackup = $backup['auto_backup'] ?? null;
                                @endphp
                                <option value="off" @selected($autoBackup == 'off')>{{ __("Off") }}</option>
                                <option value="daily" @selected($autoBackup == 'daily')>{{ __("Every Day") }}</option>
                                <option value="weekly" @selected($autoBackup == 'weekly')>{{ __("Every Week") }}</option>
                                <option value="monthly" @selected($autoBackup == 'monthly')>{{ __("Every Month") }}</option>
                                <option value="yearly" @selected($autoBackup == 'yearly')>{{ __("Every Year") }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __("Archive Password") }}</label>
                            <input type="text" name="password" id="password" class="form-control" value="{{ $backup['password'] ?? config('backup.backup.password') }}" placeholder="{{ __('Enter backup file password') }}">
                            <small class="text-secondary">{{ __("The password to be used for archive encryption") }}</small>
                        </div>

                        <div class="form-group">
                            <label for="disks">{{ __("Disks") }}</label>
                            <select name="disks[]" id="disks" data-control="select2" data-placeholder="{{ __('Select storage disks') }}" multiple>
                                <option></option>
                                @php
                                    $disks = $backup['disks'] ?? config('backup.backup.destination.disks');
                                @endphp
                                <option value="local" @selected(in_array('local', $disks))>{{ __("Local") }}</option>
                                <option value="public" @selected(in_array('public', $disks))>{{ __("Public") }}</option>
                                <option value="s3" @selected(in_array('s3', $disks))>{{ __("S3") }}</option>
                            </select>
                        </div>

                        <hr>
                        <h3>{{ __('Slack Notification') }}</h3>
                        <div class="form-group">
                            <label for="slack_webhook_url">{{ __("Webhook Url") }}</label>
                            <input type="url" name="slack_webhook_url" id="slack_webhook_url" class="form-control" value="{{ $backup['slack_webhook_url'] ?? null }}" placeholder="{{ __('Enter webhook url') }}">
                        </div>
                        <div class="form-group">
                            <label for="slack_channel">{{ __("Channel") }}</label>
                            <input type="text" name="slack_channel" id="slack_channel" class="form-control" value="{{ $backup['slack_channel'] ?? null }}" placeholder="{{ __('Enter channel') }}">
                            <small class="text-secondary">{{ __("If this is set to null the default channel of the webhook will be used.") }}</small>
                        </div>
                        <div class="form-group">
                            <label for="slack_username">{{ __("Username") }}</label>
                            <input type="text" name="slack_username" id="slack_username" class="form-control" value="{{ $backup['slack_username'] ?? null }}" placeholder="{{ __('Enter username') }}">
                        </div>
                        <div class="form-group">
                            <label for="slack_icon">{{ __("Icon") }}</label>
                            <input type="text" name="slack_icon" id="slack_icon" class="form-control" value="{{ $backup['slack_icon'] ?? null }}" placeholder="{{ __('Enter icon') }}">
                        </div>

                        <hr>
                        <h3>{{ __('Discord Notification') }}</h3>
                        <div class="form-group">
                            <label for="discord_webhook_url">{{ __("Webhook Url") }}</label>
                            <input type="url" name="discord_webhook_url" id="discord_webhook_url" class="form-control" value="{{ $backup['discord_webhook_url'] ?? null }}" placeholder="{{ __('Enter webhook url') }}">
                        </div>

                        <div class="form-group">
                            <label for="discord_username">{{ __("Username") }}</label>
                            <input type="text" name="discord_username" id="discord_username" class="form-control" value="{{ $backup['discord_username'] ?? null }}" placeholder="{{ __('Enter username') }}">
                            <small class="text-secondary">{{ __("If this is an empty string, the name field on the webhook will be used.") }}</small>
                        </div>
                        <div class="form-group">
                            <label for="discord_avatar_url">{{ __("Avatar Url") }}</label>
                            <input type="url" name="discord_avatar_url" id="discord_avatar_url" class="form-control" value="{{ $backup['discord_avatar_url'] ?? null }}" placeholder="{{ __('Enter avatar url') }}">
                            <small class="text-secondary">{{ __("If this is an empty string, the avatar on the webhook will be used.") }}</small>
                        </div>

                        <button class="btn btn-primary waves-effect waves-light float-right submit-button">
                            <i class="fas fa-save"></i>
                            {{ __("Save") }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
