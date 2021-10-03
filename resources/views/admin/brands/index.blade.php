@extends('admin.layouts.master')

@section('title')
    Brands
@endsection

@section('content')
    <div class="container-fluid p-4 rounded-2">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-white rounded-2">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <h5 class="me-3">Brands</h5>
                        <a href="{{ route('admin.brands.create') }}" class="btn btn-style-1 no-duration btn-light-primary d-flex align-items-center">
                            <i class="fa fa-plus me-2"></i>
                            New
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table custom-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>SLUG</th>
                                <th>ACTIVE</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th>ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($attributes->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center pt-4 pb-4">No records found</td>
                                </tr>
                            @endif

                            @foreach($brands as $key => $brand)
                                <tr>
                                    <td>{{ $brands->firstItem() + $key }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->slug }}</td>
                                    <td>
                                        <div class="d-flex align-items-center {{ $brand->is_active ? "custom-text-primary" : "custom-text-danger" }}">
                                            <i class="fa fa-circle me-1" style="font-size: 8px"></i>
                                            <span class="custom-text-bold">{{ $brand->is_active ? 'Active' : 'Inactive' }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $brand->created_at }}</td>
                                    <td>{{ $brand->updated_at }}</td>
                                    <td>
                                        <div class="cell-actions">
                                            <a href="{{ route('admin.brands.edit', $brand->id) }}" title="edit"><i class="fad fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
