@extends('admin.layouts.master')

@section('title')
    Products
@endsection

@section('content')
    <div class="container-fluid p-4 rounded-2">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-white rounded-2">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <h5 class="me-3">Products</h5>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-style-1 no-duration btn-light-primary d-flex align-items-center">
                            <i class="fa fa-plus me-2"></i>
                            New
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table custom-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>PRODUCT</th>
                                <th>SLUG</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>ACTIVE</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th>ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($products->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center pt-4 pb-4">No records found</td>
                                </tr>
                            @endif
                            @foreach($products as $key => $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $key }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/'.$product->primary_image) }}" alt="{{ $product->name }} primary image" height="70" width="70" class="me-2">
                                            <span>{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center {{ $product->is_active ? "custom-text-primary" : "custom-text-danger" }}">
                                            <i class="fa fa-circle me-1" style="font-size: 8px"></i>
                                            <span class="custom-text-bold">{{ $product->is_active ? 'Active' : 'Inactive' }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td>
                                        <div class="cell-actions">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" title="edit"><i class="fad fa-edit"></i></a>
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
