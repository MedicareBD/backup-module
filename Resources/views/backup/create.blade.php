@extends('core::layouts.admin.app')

@section('title', __('Create Backup'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Create Backup') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.backup.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> {{ __("Backup Lists") }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.backup.store') }}" method="post" class="instant_reload_form">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('File Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __("Enter backup filename") }}" value="{{ config('app.name') }}">
                        </div>
                        <div class="form-group">
                            <label for="backup_type">{{ __('File Name') }}</label>
                            <select name="backup_type" id="backup_type" class="form-control" data-control="select2" data-placeholder="{{ __("Select Backup Type") }}" required>
                                <option value=""></option>
                                <option value="only_db">{{ __("Only Database") }}</option>
                                <option value="only_files">{{ __("Only File") }}</option>
                                <option value="full_backup">{{ __("Full Backup") }}</option>
                            </select>
                        </div>

                        <button class="btn btn-primary waves-effect waves-light submit-button float-right">
                            <i class="fas fa-hdd"></i> {{ __('Backup') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
