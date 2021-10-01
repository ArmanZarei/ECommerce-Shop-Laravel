@extends('admin.layouts.master')

@section('title')
    Create Brand
@endsection

@section('content')
    <div class="container-fluid p-4 rounded-2">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-white rounded-2">
                    <h5 class="card-header bg-white">Create brand</h5>
                    <div class="card-body">
                        <form class="custom-form me-5 ms-5 mt-2" action="{{ route('admin.brands.update', $brand->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="col-3 mb-3">
                                <div class="floating-label-container">
                                    <input type="text" name="name" autocomplete="off" placeholder=" " class="{{ $errors->has('name') ? 'has-error' : '' }}" value="{{ $brand->name }}">
                                    <label>Name</label>
                                </div>
                                @if($errors->has('name'))
                                    <p class="input-error">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <span class="me-3 ms-1">Active</span>
                                <input type="checkbox" class="ios-button" name="is_active" {{ $brand->is_active ? 'checked' : '' }}>
                            </div>
                            <button class="btn btn-style-1 no-duration btn-light-primary mr-2">Submit</button>
                            <a href="{{ route('admin.brands.index') }}" class="btn btn-style-1 no-duration btn-light-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
