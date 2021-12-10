@extends('front.layouts.master')

@section('title', 'Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/common/formcomponents.css') }}">
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 offset-lg-4 offset-md-2">
                <div class="card">
                    <div class="card-header"><i class="fad fa-sign-in me-2"></i>Login</div>
                    <div class="card-body">
                        <x-form.form action="{{ route('login') }}">
                            <x-form.inputs.text name="email" />
                            <x-form.inputs.text name="password" type="password" containerClass="mt-3"/>
                            <x-form.inputs.submit class="mt-3" />
                        </x-form.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
