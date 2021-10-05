@extends('admin.layouts.master')

@section('title')
    Edit Tag
@endsection

@section('content')
    <div class="container-fluid p-4 rounded-2">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-white rounded-2">
                    <h5 class="card-header bg-white">Edit tag</h5>
                    <div class="card-body">
                        <form class="custom-form me-5 ms-5 mt-2" action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="col-3 mb-3">
                                <div class="floating-label-container">
                                    <input type="text" name="name" autocomplete="off" placeholder=" " class="{{ $errors->has('name') ? 'has-error' : '' }}" value="{{ $tag->name }}">
                                    <label>Name</label>
                                </div>
                                @if($errors->has('name'))
                                    <p class="input-error">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <button class="btn btn-style-1 no-duration btn-light-primary mr-2">Submit</button>
                            <a href="{{ route('admin.tags.index') }}" class="btn btn-style-1 no-duration btn-light-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
