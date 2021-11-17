@extends('front.layouts.master')

@section('title', 'Homepage')

@section('content')
    <div class="container mt-5">
        @foreach($products as $product)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ $product->primaryImageUrl }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::words($product->description, 10) }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between"><span>Brand</span><span>{{ $product->brand->name }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Category</span><span>{{ $product->category->name }}</span></li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link btn btn-outline-primary">Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
