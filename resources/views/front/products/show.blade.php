@extends('front.layouts.master')

@section('title', 'Product '.$product->name)

{{-- TODO : Rating --}}
@section('content')
    <div class="container mt-5">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4 p-4">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            @for($i = 1; $i <= sizeof($product->images); $i++)
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $i }}" aria-label="Slide {{ $i }}"></button>
                            @endfor
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active p-5">
                                <img src="{{ $product->primaryImageUrl }}" class="d-block w-100" alt="Product Primary Image">
                            </div>
                            @foreach($product->images as $image)
                                <div class="carousel-item p-5">
                                    <img src="{{ $image->imageUrl }}" class="d-block w-100" alt="Product Image">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h1 class="card-title h3">{{ $product->name }}</h1>
                        <hr>
                        <h6 class="fw-bold">Description: </h6>
                        <p class="card-text ms-3">{{ $product->description }}</p>
                        <hr>
                        <h6 class="fw-bolder">Attributes</h6>
                        <ul>
                            @foreach($product->attributes as $attribute)
                                <li><span class="fw-bold">{{ $attribute->name }}:</span> {{ $attribute->pivot->value }}</li>
                            @endforeach
                        </ul>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <h6 class="fw-bolder">Category</h6>
                                <span class="ms-3">{{ $product->category->parent->name }} / {{ $product->category->name }}</span>
                            </div>
                            <div class="col-6">
                                <h6 class="fw-bolder">Tags</h6>
                                <div id="product-tags">
                                    @foreach($product->tags as $tag)
                                        <span class="badge bg-primary">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h6 class="fw-bolder">Variations</h6>
                        <div class="ms-3 d-flex">
                            <div>
                                {{ $product->variations[0]->attribute->name }}:
                                <select class="form-select d-inline form-select-sm shadow-none" aria-label="Default select example" style="width: 150px;" id="product-variation">
                                    @foreach($product->variations as $variation)
                                        <option value="{{ $variation->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $variation->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="ms-auto d-flex align-items-center">
                                <span class="text-secondary" style="font-size: 25px">
                                    <i class="fad fa-warehouse-alt fw-lighter"></i>
                                    <span id="product-quantity" class="fw-lighter">{{ number_format($product->variations[0]->quantity) }}</span> <span class="fw-lighter">in stock</span>
                                </span>
                                <span class="text-success ms-4" style="font-size: 25px">
                                    <i class="fa fa-dollar-sign fw-lighter"></i>
                                    <span id="product-price" class="fw-lighter">{{ number_format($product->variations[0]->price) }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@once
    @push('scripts')
        <script>
            const variationsPrices = @json(array_combine(
                $product->variations->pluck('id')->toArray(),
                $product->variations->map(fn ($item, $key) => number_format($item->price) )->toArray())
            );
            const variationsQuantities = @json($product->variations->pluck('quantity', 'id')->toArray());

            $(document).ready(function () {
                $("#product-variation").on('click', function (e) {
                    $("#product-price").html(variationsPrices[$(this).val()]);
                    $("#product-quantity").html(variationsQuantities[$(this).val()]);
                });
            });
        </script>
    @endpush
@endonce
