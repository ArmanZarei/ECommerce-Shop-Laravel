@extends('admin.layouts.master')

@section('title')
    Create Category
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

    <script>
        let selectedAttr = new Set(@json(old('attributes') ?? []));
        const attrsElem = document.getElementById('attributes');
        const filterElem = document.getElementById('filterable-attributes');
        const variationElem = document.getElementById('variation-attribute');

        $(document).ready(function () {
            $('#attributes').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                const optionVal = attrsElem.children[clickedIndex].value;
                const optionText = attrsElem.children[clickedIndex].innerText;
                if (selectedAttr.has(optionVal)) {
                    filterElem.removeChild(filterElem.querySelector(`option[value='${optionVal}']`));
                    variationElem.removeChild(variationElem.querySelector(`option[value='${optionVal}']`));
                    selectedAttr.delete(optionVal);
                } else {
                    for (let container of [filterElem, variationElem]) {
                        const option = document.createElement('option');
                        option.innerText = optionText;
                        option.value = optionVal;
                        container.append(option);
                    }
                    selectedAttr.add(optionVal);
                }
                $('#filterable-attributes').selectpicker('refresh');
                $('#variation-attribute').selectpicker('refresh');
            })

            let iconPreviewTimeoutID = null;
            $('input[name="icon"]').on('input', function () {
                const val = $(this).val()
                clearTimeout(iconPreviewTimeoutID);
                iconPreviewTimeoutID = setTimeout(() => $('#icon-preview').html(`<i class="${val} fa-2x"></i>`), 500);
            });
        });
    </script>
@endpush

@section('content')
    <div class="container-fluid p-4 rounded-2">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-white rounded-2">
                    <h5 class="card-header bg-white">Create category</h5>
                    <div class="card-body">
                        <form class="custom-form me-5 ms-5 mt-2" action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-4">
                                    <div class="floating-label-container">
                                        <input type="text" name="name" autocomplete="off" placeholder=" " class="{{ $errors->has('name') ? 'has-error' : '' }}" value="{{ old('name') }}">
                                        <label>Name</label>
                                    </div>
                                    @if($errors->has('name'))
                                        <p class="input-error">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="floating-label-container">
                                                <input type="text" name="icon" autocomplete="off" placeholder=" " value="{{ old('icon') }}">
                                                <label>Icon</label>
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex align-items-center justify-content-start" id="icon-preview">
                                            @if(old('icon'))
                                                <i class="{{ old('icon') }} fa-2x"></i>
                                            @else
                                                <i class="fad fa-engine-warning fa-2x" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Use Fontawesome classes"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 position-relative">
                                    <span class="custom-span-input-label">Parent</span>
                                    <select class="selectpicker" data-live-search="true" name="parent_id">
                                        <option value="" selected>No parent</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == old('parent_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-4 position-relative">
                                    <span class="custom-span-input-label">Attributes</span>
                                    <select id="attributes" class="selectpicker" data-live-search="true" name="attributes[]" multiple>
                                        @php($oldAttrIds = old('attributes') ?? [])
                                        @foreach($attributes as $attribute)
                                            <option value="{{ $attribute->id }}" {{ in_array($attribute->id, $oldAttrIds) ? 'selected' : '' }}>{{ $attribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @php($oldAttrs = $attributes->whereIn('id', array_map('intval', $oldAttrIds)))
                                <div class="col-4 position-relative">
                                    <span class="custom-span-input-label">Filterable Attributes</span>
                                    <select id="filterable-attributes" class="selectpicker" data-live-search="true" name="filterable_attributes[]" multiple>
                                        @php($oldFilterableAttrs = old('filterable_attributes') ?? [])
                                        @foreach($oldAttrs as $attribute)
                                            <option
                                                value="{{ $attribute->id }}"
                                                {{ in_array($attribute->id, $oldFilterableAttrs) ? 'selected' : '' }}
                                            >
                                                {{ $attribute->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4 position-relative">
                                    <span class="custom-span-input-label">Variation Attribute</span>
                                    <select id="variation-attribute" class="selectpicker" data-live-search="true" name="variation_attribute">
                                        <option value="">No variation attribute</option>
                                        @foreach($oldAttrs as $attribute)
                                            <option
                                                value="{{ $attribute->id }}"
                                                {{ $attribute->id == old('variation_attribute') ? 'selected' : '' }}
                                            >
                                                {{ $attribute->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="floating-label-container">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder=" " name="description">{{ old('description') }}</textarea>
                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-5">
                                <span class="me-3 ms-1">Active</span>
                                <input type="checkbox" class="ios-button" name="is_active" checked>
                            </div>
                            <button class="btn btn-style-1 no-duration btn-light-primary mr-2">Submit</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-style-1 no-duration btn-light-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
