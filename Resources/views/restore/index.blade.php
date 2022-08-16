@extends('layouts.admin.app')

@section('title', __('Restore System'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __("Restore System") }}</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        <strong> <i class="fas fa-exclamation-triangle"></i></strong>
                        {{ __("Note : Please backup your system.") }}
                        <a href="{{ route('admin.backup.index') }}" class="btn btn-dark btn-sm waves-effect waves-light ml-3">
                            <i class="fas fa-hdd"></i>
                            {{ __("Backup Now") }}
                        </a>
                    </div>

                    <form action="{{ route('admin.restore.database-restore') }}" method="post" class="instant_reload_form" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="database" class="required">{{ __('Database File') }}</label>
                            <input type="file" name="database" id="database" class="form-control" required>
                        </div>

                        <button class="btn btn-primary waves-effect waves-light w-100 submit-button">
                            <i class="fas fa-upload"></i>
                            {{ __("Restore Database") }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
