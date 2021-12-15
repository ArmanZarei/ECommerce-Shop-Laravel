@extends('front.layouts.master')

@section('title', 'Product '.$product->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home/comments.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/formcomponents.css') }}">
@endpush

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
    <div class="container mt-5">
        <h5>Comments</h5>
        <hr>
        <div id="comments-container">
            @if(sizeof($product->approvedComments) == 0)
                <div class="alert alert-warning text-center">No Comments</div>
            @endif
            @foreach($product->approvedComments as $comment)
                <div class="comment">
                    <div class="container_comment_avatar_role">
                        <div class="comment-avatar">
                            <img alt="" src="https://avatars.githubusercontent.com/u/45759498?v=4" srcset="http://0.gravatar.com/avatar/feee02e2b880ad601fe7ff7947b7776c?s=180&amp;d=mm&amp;r=g 2x" class="avatar avatar-90 photo" height="90" width="90">
                        </div>
                    </div>
                    <div class="comment_text_wrapper">
                        <div class="d-flex align-items-center">
                            <span class="comment_author">{{ $comment->user->name }}</span>
                            <div class="text-warning">
                                @for($i = 0; $i < $commentsRate[$comment->id]; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for($i = 0; $i < 5-$commentsRate[$comment->id]; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            </div>
                            @if($comment->status == App\Models\Comment::STATUS_PENDING)
                                <span class="bg-warning comment-awaiting-moderation">Waiting for approval</span>
                            @endif
                        </div>
                        {{-- TODO --}}
                        {{--<div class="action-btn-group float-left d-inline-block" style="margin: 7px 10px;">
                            <a href="" class="admin-btn-action text-success" title="Accept" data-status="accepted" data-commentid=""><i class="fa fa-check"></i></a>
                            <a href="" class="admin-btn-action text-danger" title="Reject" data-status="rejected" data-commentid=""><i class="fa fa-times"></i></a>
                        </div>--}}
                        <div class="comment-content">
                            <p style="margin-top: 15px;">{{ $comment->text }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr class="mt-5">
        <div class="row mt-5">
            <div class="col-md-6 col-12 offset-md-3">
                <h6 class="text-center">Submit a comment</h6>
                <hr>
                <div class="rating-container text-warning">
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                @error('rate')
                    <span style="color: #F64E60;">{{ $message }}</span>
                @enderror
                <x-form.form action="{{ route('comment.create', $product->id) }}" class="mb-5 mt-3">
                    <input type="hidden" name="rate">
                    <x-form.inputs.textarea name="content" />
                    <x-form.inputs.submit class="mt-3" />
                </x-form.form>
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

        <script>
            const ratingContainer = document.getElementById('rating-container');
            const stars = document.querySelectorAll('.rating-container i');
            const rateInput = document.querySelector('input[name="rate"]');
            stars.forEach(star => {
                star.addEventListener('click', e => {
                    let s = e.target;
                    let cnt = 0;
                    while (s != null) {
                        s.classList.remove('far');
                        s.classList.add('fas');
                        s = s.previousElementSibling;
                        cnt++;
                    }
                    s = e.target.nextElementSibling;
                    while (s != null) {
                        s.classList.remove('fas');
                        s.classList.add('far');
                        s = s.nextElementSibling;
                    }
                    rateInput.value = cnt;
                });
            })
        </script>
    @endpush
@endonce
