@extends('admin.layouts.master')

@section('title')
    Attributes
@endsection

@section('content')
    <div class="container-fluid p-4 rounded-2">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-white rounded-2">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <h5 class="me-3">Attributes</h5>
                        <a href="{{ route('admin.attributes.create') }}" class="btn btn-style-1 no-duration btn-light-primary d-flex align-items-center">
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
                            @foreach($attributes as $key => $attribute)
                                <tr>
                                    <td>{{ $attributes->firstItem() + $key }}</td>
                                    <td>{{ $attribute->name }}</td>
                                    <td>{{ $attribute->created_at }}</td>
                                    <td>{{ $attribute->updated_at }}</td>
                                    <td>
                                        <div class="cell-actions">
                                            <a href="{{ route('admin.attributes.edit', $attribute->id) }}" title="edit"><i class="fad fa-edit"></i></a>
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
