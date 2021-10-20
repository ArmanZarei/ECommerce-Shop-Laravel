@extends('admin.layouts.master')

@section('title')
    Create Banner
@endsection

@section('content')
    <div class="container-fluid p-4 rounded-2">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-white rounded-2">
                    <h5 class="card-header bg-white">Create banner</h5>
                    <div class="card-body">
                        <x-form.form action="{{ route('admin.banners.store') }}" class="me-5 ms-5 mt-2" enctype="multipart/form-data" id="create-form">
                            <div class="row mb-5 justify-content-between">
                                <div class="col-3 d-flex flex-column align-items-center">
                                    <span class="fw-light">Main Image</span>
                                    <div class="ms-3 mt-2" style="width: 300px; height: 300px">
                                        <x-form.inputs.image name="image" />
                                    </div>
                                </div>
                                <div class="col-9 mt-5">
                                    <div class="row">
                                        <div class="col-8">
                                            <x-form.inputs.text name="link"/>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-3">
                                            <x-form.inputs.text name="priority"/>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <x-form.inputs.switch name="is_active" label="Active"/>
                                    </div>
                                </div>
                            </div>

                            <x-form.inputs.submit />
                            <x-form.inputs.cansel :route="route('admin.banners.index')" />
                        </x-form.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
