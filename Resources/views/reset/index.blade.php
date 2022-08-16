@extends('layouts.admin.app')

@section('title', __('Backup Settings'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __("Reset System") }}</h4>
                </div>
                <div class="card-body py-5">
                    <div class="alert alert-danger">
                        <strong> <i class="fas fa-exclamation-triangle"></i></strong>
                        {{ __("Note : If You Reset Your System your Whole database will be blank.") }}
                    </div>

                    <button
                        class="btn btn-primary w-100 confirm-action"
                        data-content="{{ __('Are You Sure?') }}"
                        data-icon="fas fa-warning"
                        data-action="{{ route('admin.reset.run') }}"
                    >
                        <i class="fas fa-exchange"></i>
                        {{ __('Reset') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
