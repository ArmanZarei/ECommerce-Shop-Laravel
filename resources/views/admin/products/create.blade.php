@extends('admin.layouts.master')

@section('title')
    Create Product
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <style>
        i.remove-product-variation {
            position: absolute;
            left: 20px;
            top: 11px;
            font-size: 20px;
            width: auto;
            padding: 4px 7px;
            border-radius: 8px;
            cursor: pointer;
        }

        #add-product-variation {
            font-size: 20px;
            margin-left: 2px;
            padding: 4px 7px;
            border-radius: 8px;
            cursor: pointer;
        }

        #add-product-images {
            font-size: 18px;
            margin-left: 8px;
            padding: 3px 6px;
            border-radius: 8px;
            cursor: pointer;
        }
        i.delete-input {
            position: absolute;
            border-radius: 50%;
            cursor: pointer;
            top: 0;
            right: 0;
            transform: translate(calc(50% - 5px), calc(-50% + 5px));
            padding: 5px 8px;
            font-size: 17px;
            z-index: 999;
        }
    </style>
@endpush

{{-- TODO: Clean Code !!! --}}

@php($variationAttr = $attributes ? $attributes->where('pivot.is_variation', true)->first() : null)

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

    <script>
        const categoryAttrUrl = '{{ route("api.category.attributes", ":id") }}';
        let productVariationCounter = @json(old('product_variations') ? sizeof(old('product_variations')) : 0);

        function createAttrInputString(name, label, extraClasses="col-3 mb-3 bubble-animation", value="") {
            return `<div class="input-container ${extraClasses}">
                        <div class="floating-label-container">
                            <input type="text" name="${name}" autocomplete="off" placeholder=" " value="${value}">
                            <label>${label}</label>
                        </div>
                    </div>`;
        }

        function createProductVariationForm(value="", price="", quantity="") {
            const pv =  $(`<div class="row product-variation ps-5 relative mb-3">
                               <i class="fal fa-times remove-product-variation btn-light-danger"></i>
                               <div class="col-3">
                                   ${createAttrInputString(`product_variations[${productVariationCounter}][value]`, "Value", "", value)}
                               </div>
                               <div class="col-3">
                                   ${createAttrInputString(`product_variations[${productVariationCounter}][price]`, "Price", "", price)}
                               </div>
                               <div class="col-3">
                                   ${createAttrInputString(`product_variations[${productVariationCounter}][quantity]`, "Quantity", "", quantity)}
                               </div>
                           </div>`);
            pv.find('.remove-product-variation').on('click', function () {
                pv.remove();
            });
            productVariationCounter++;

            return pv;
        }

        $(document).ready(function () {
            const categoryAttributesContainer = $("#category-attributes");
            const productVariations = $("#product-variations");
            const productVariationsContainer = $("#pvs-container");
            const productImagesContainer = $("#product-images-container");

            $("select[name='category_id']").on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                categoryAttributesContainer.html("");
                productVariations.addClass('d-none');
                productVariationsContainer.html("");

                const clickedElemVal = $(this).children().eq(clickedIndex).val();
                $.get(categoryAttrUrl.replace(':id', clickedElemVal), function (response) {
                    const attributes = response.filter(attr => attr.pivot.is_variation === 0);
                    const variation = response.find(attr => attr.pivot.is_variation);
                    attributes.forEach((attr, index) => {
                        setTimeout(() => {
                            categoryAttributesContainer.append($(createAttrInputString(`attributes[${attr.id}]`, attr.name)));
                        }, 100*index);
                    });

                    if (variation) {
                        productVariations.removeClass('d-none');
                        $("#pv-label").text(`(${variation.name})`);
                    }
                });
            });

            $('#add-product-variation').on('click', function () {
                productVariationsContainer.append(createProductVariationForm());
            });


            let filesIdCounter = 0
            const fileIdsMap = new Map();
            function createImage(id, imgUrl) {
                const elem = $(`<div class="col-3" style="margin-bottom: 25px">
                                <div class="d-inline-block" style="width: 200px; height: 200px">
                                    <div class="image-input-container">
                                        <i class="image-input-action delete-input fal fa-times"></i>
                                        <img src="${imgUrl}">
                                    </div>
                                </div>
                            </div>`);
                elem.find('.delete-input').on('click', function () {
                    elem.remove();
                    fileIdsMap.delete(id);
                });

                return elem;
            }
            $('#add-product-images').on('click', function () {
                $("#images-input").click();
            });
            $("#images-input").on('change', function () {
                for (let file of $(this).prop('files')) {
                    fileIdsMap.set(filesIdCounter, file);
                    productImagesContainer.append(createImage(filesIdCounter, URL.createObjectURL(file)));
                    filesIdCounter++;
                }
                $(this).val('');
            });

            $("#create-form").on('submit', function () {
                const dataTransfer = new DataTransfer();
                for (let file of fileIdsMap.values())
                    dataTransfer.items.add(file)
                $("#images-input").prop('files', dataTransfer.files);
            });

            $('.remove-product-variation').on('click', function () {
                $(this).parent('.product-variation').remove();
            });
        });
    </script>
@endpush

@section('content')
    <div class="container-fluid p-4 rounded-2">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-white rounded-2">
                    <h5 class="card-header bg-white">Create product</h5>
                    <div class="card-body">
                        <form action="" ></form>
                        <x-form.form action="{{ route('admin.products.store') }}" class="me-5 ms-5 mt-2" enctype="multipart/form-data" id="create-form">
                            <div class="row mb-4">
                                <div class="col-3">
                                    <x-form.inputs.text name="name"/>
                                </div>
                                <div class="col-3">
                                    <x-form.inputs.select name="brand_id" label="Brand" :dataArray="$brands"/>
                                </div>
                                <div class="col-4">
                                    <x-form.inputs.select name="tag_ids" label="Tags" :dataArray="$tags" :multiple="true"/>
                                </div>
                                <div class="col-2 d-flex align-items-center justify-content-center">
                                    <x-form.inputs.switch name="is_active" label="Active"/>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <x-form.inputs.textarea name="description" />
                            </div>
                            <div class="row mb-3">
                                <div class="col-3">
                                    <x-form.inputs.select name="category_id" label="Category" :dataArray="$categories"/>
                                </div>
                            </div>
                            <div class="row mb-3" id="category-attributes">
                            @if($attributes)
                                @foreach($attributes->where('pivot.is_variation', false) as $attr)
                                    <div class="input-container col-3 mb-3">
                                        <x-form.inputs.text :name='"attributes[$attr->id]"' :label="$attr->name" :value="old('attributes')[$attr->id]" :error-key='"attributes.$attr->id"' />
                                    </div>
                                @endforeach
                            @endif
                            </div>

                            <div id="product-variations" class="mb-4 {{ !$variationAttr ? "d-none" : '' }}">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="me-2">Product Variations <strong id="pv-label">{{$variationAttr ? $variationAttr->name : ''}}</strong></span>
                                    <i class="fal fa-plus btn-light-success" id="add-product-variation"></i>
                                </div>
                                <div id="pvs-container">
                                    @if ($errors->has('product_variations'))
                                        <p class="input-error">{{ $errors->first('product_variations') }}</p>
                                    @endif

                                    @if ($variationAttr && old('product_variations'))
                                        @foreach(old('product_variations') as $k => $productVariation)
                                            <div class="row product-variation ps-5 relative mb-3">
                                                <i class="fal fa-times remove-product-variation btn-light-danger"></i>
                                                <div class="col-3">
                                                    <x-form.inputs.text :name='"product_variations[$loop->index][value]"' label="Value" :value="old('product_variations')[$k]['value']" :error-key='"product_variations.$k.value"' />
                                                </div>
                                                <div class="col-3">
                                                    <x-form.inputs.text :name='"product_variations[$loop->index][price]"' label="Price" :value="old('product_variations')[$k]['price']" :error-key='"product_variations.$k.price"' />
                                                </div>
                                                <div class="col-3">
                                                    <x-form.inputs.text :name='"product_variations[$loop->index][quantity]"' label="Quantity" :value="old('product_variations')[$k]['quantity']" :error-key='"product_variations.$k.quantity"' />
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <hr class="mt-5 mb-5">

                            <div class="row mb-5 justify-content-between">
                                <div class="col-3 d-flex flex-column align-items-center">
                                    <span class="fw-light">Main Image</span>
                                    <div class="ms-3 mt-2" style="width: 300px; height: 300px">
                                        <x-form.inputs.image name="main_image" />
                                    </div>
                                </div>
                                <div class="col-8">
                                    <d class="d-flex align-items-center">
                                        <span>Other Images</span>
                                        <i class="fal fa-plus btn-light-primary" id="add-product-images"></i>
                                    </d>
                                    <div class="row mt-4" id="product-images-container">
                                        @if($errors->has('images'))
                                            <p class="input-error mb-4">{{ $errors->first('images') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <input type="file" class="hidden" id="images-input" multiple name="images[]">

                            <x-form.inputs.submit />
                            <x-form.inputs.cansel :route="route('admin.products.index')" />
                        </x-form.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
