@extends('front.layouts.master')

@section('title', $category->name.' Category')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
                @foreach($filterableAttributes as $attr)
                    <h5>{{ $attr->name }}</h5>
                    <div class="ms-3">
                        @foreach($attr->values as $val)
                            <input type="checkbox" id="{{ $attr->id.'-'.$val->value }}" class="mt-2">
                            <label for="{{ $attr->id.'-'.$val->value }}">{{ $val->value }}</label>
                            <br>
                        @endforeach
                    </div>
                    <hr>
                @endforeach
                @if($variation)
                    <h5>{{ $variation->name }}</h5>
                    <div class="ms-3">
                        @foreach($variation->variationValues as $val)
                            <input type="checkbox" id="{{ $attr->id.'-'.$val->value }}" class="mt-2">
                            <label for="{{ $attr->id.'-'.$val->value }}">{{ $val->value }}</label>
                            <br>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-9">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-4">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{ $product->primaryImageUrl }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ \Illuminate\Support\Str::words($product->description, 10) }}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Brand</span><span>{{ $product->brand->name }}</span></li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Category</span><span>{{ $product->category->name }}</span></li>
                                </ul>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ route('front.product.show', $product->id) }}"
                                           class="card-link btn btn-outline-primary">Details</a>
                                        @if($variation = $product->availableVariation)
                                            <span class="text-success"><i class="fa fa-dollar-sign"></i> {{ number_format($variation->price) }}</span>
                                        @else
                                            <span class="text-danger">Out of stock</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

