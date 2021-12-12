@extends('front.layouts.master')

@section('title', 'Register')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/common/formcomponents.css') }}">
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 offset-lg-4 offset-md-2">
                <div class="card">
                    <div class="card-header"><i class="fad fa-user-plus me-2"></i>Register</div>
                    <div class="card-body">
                        <x-form.form action="{{ route('register') }}">
                            <x-form.inputs.text name="name" />
                            <x-form.inputs.text name="email" containerClass="mt-3" />
                            <x-form.inputs.text name="password" type="password" containerClass="mt-3"/>
                            <x-form.inputs.text name="password_confirmation" label="Password Confirmation" type="password" containerClass="mt-3"/>
                            <x-form.inputs.text name="cellphone" containerClass="mt-3" />
                            <x-form.inputs.submit class="mt-3" />
                        </x-form.form>
                        <hr />
                        <a class="btn btn-style-1 no-duration btn-light-dark mr-2 d-block" href="{{ route('provider.login', 'github') }}">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fab fa-github me-2" style="font-size: 23px"></i>Login with Github
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
