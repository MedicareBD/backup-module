@extends('layouts.admin.app')

@section('title', __('Manage Backups'))

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>@lang('Backup List')</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.backup.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> @lang('Create Backup')
                        </a>
                        <a href="{{ route('admin.backup.settings.index') }}" class="btn btn-primary">
                            <i class="fas fa-cog"></i> @lang('Backup Setting')
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    {{ $dataTable->scripts() }}
@endpush
