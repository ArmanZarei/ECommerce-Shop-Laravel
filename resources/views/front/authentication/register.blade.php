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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
