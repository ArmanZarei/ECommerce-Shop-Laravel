@extends('admin.layouts.master')

@section('title')
    Products
@endsection

@push('styles')
    <style>
        .product-gallery-image {
            width: 200px;
            height: 200px;
            padding: 10px;
            float: left;
            margin: 10px;
            box-shadow: 0 0.5rem 1.5rem 0.5rem #e1e1e1;
            border-radius: 5px;
            background: #FFF;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

@push('scripts')
    <script>
        const $productImages = @json(array_combine($products->pluck('id')->toArray(), $products->pluck('images.*.imageUrl')->toArray()));
        const $productImagesMap = new Map(Object.entries($productImages));

        const mainModal = new bootstrap.Modal(document.getElementById('mainModal'));
        const mainModalTitle = document.getElementById('mainModalLabel');
        const mainModalBody = document.querySelector('#mainModal .modal-body');
        function openModal(title, content) {
            mainModalTitle.innerText = title;
            mainModalBody.innerHTML = content;
            mainModal.show();
        }

        $(document).ready(function () {
            $('.show-gallery-btn').on('click', function (e) {
                e.preventDefault();

                const imagesUrl = $productImagesMap.get($(this).data('pid').toString());
                let images = imagesUrl.reduce((prev, url) => prev + `<div class="product-gallery-image"><img src="${url}" /></div>`, '');
                if (images === '')
                    images = '<p class="alert alert-warning">No image found</p>'
                openModal('Image Gallery', images);
            });
        });
    </script>
@endpush

@section('content')
    <div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mainModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
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
                                            <img src="{{ $product->primaryImageUrl }}" alt="{{ $product->name }} primary image" height="70" width="70" class="me-2">
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
                                            <a href="#" class="show-gallery-btn" data-pid="{{ $product->id }}" title="Image Gallery"><i class="fas fa-images"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="custom-pagination mt-4">
                            {{ $products->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
