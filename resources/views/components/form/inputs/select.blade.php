@props(['name', 'dataArray', 'multiple' => false, 'dataValue' => 'id', 'dataName' => 'name', 'label' => null])
@php($label = $label ?? ucwords($name))

<div class="input-relative position-relative">
    <span class="custom-span-input-label">{{ $label }}</span>
    <select class="selectpicker" data-live-search="true" name="{{ $name }}" {{ $multiple ? 'multiple' : '' }}>
        @foreach($dataArray as $data)
            <option value="{{ $data->$dataValue }}" {{ $data->$dataValue == old($name) ? 'selected' : '' }}>{{ $data->$dataName }}</option>
        @endforeach
    </select>
</div>
