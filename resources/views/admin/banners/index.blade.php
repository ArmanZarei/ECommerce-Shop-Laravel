@extends('admin.layouts.master')

@section('title')
    Banners
@endsection

@section('content')
    <div class="container-fluid p-4 rounded-2">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-white rounded-2">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <h5 class="me-3">Banners</h5>
                        <a href="{{ route('admin.banners.create') }}" class="btn btn-style-1 no-duration btn-light-primary d-flex align-items-center">
                            <i class="fa fa-plus me-2"></i>
                            New
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table custom-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>IMAGE</th>
                                <th>LINK</th>
                                <th>ACTIVE</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th>ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($banners->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center pt-4 pb-4">No records found</td>
                                </tr>
                            @endif
                            @foreach($banners as $key => $banner)
                                <tr>
                                    <td>{{ $banners->firstItem() + $key }}</td>
                                    <td style="width: 380px">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $banner->imageUrl }}" alt="banner image" height="100" width="300" class="me-2">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ $banner -> link }}">{{ $banner -> link }}</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center {{ $banner->is_active ? "custom-text-primary" : "custom-text-danger" }}">
                                            <i class="fa fa-circle me-1" style="font-size: 8px"></i>
                                            <span class="custom-text-bold">{{ $banner->is_active ? 'Active' : 'Inactive' }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $banner->created_at }}</td>
                                    <td>{{ $banner->updated_at }}</td>
                                    <td>
                                        <div class="cell-actions">
                                            <a href="{{ route('admin.banners.edit', $banner->id) }}" title="edit"><i class="fad fa-edit"></i></a>
                                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button><i class="fad fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="custom-pagination mt-4">
                            {{ $banners->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
