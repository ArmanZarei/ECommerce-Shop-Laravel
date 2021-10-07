@props(['name', 'dataArray', 'multiselect' => false, 'dataValue' => 'id', 'dataName' => 'name', 'label' => null])
@php($label = $label ?? ucwords($name))

<div class="input-relative position-relative">
    <span class="custom-span-input-label">{{ $label }}</span>
    <select class="selectpicker" data-live-search="true" name="{{ $name }}" {{ $multiselect ? 'multiselect' : '' }}>
        @foreach($dataArray as $data)
            <option value="{{ $data->$dataValue }}" {{ $data->$dataValue == old('parent_id') ? 'selected' : '' }}>{{ $data->$dataName }}</option>
        @endforeach
    </select>
</div>
