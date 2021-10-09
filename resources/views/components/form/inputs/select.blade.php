@props(['name', 'dataArray', 'multiple' => false, 'dataValue' => 'id', 'dataName' => 'name', 'label' => null])
@php($label = $label ?? ucwords($name))

<div class="input-select-container position-relative {{ $errors->has($name) ? 'has-error' : '' }}">
    <span class="custom-span-input-label">{{ $label }}</span>
    <select class="selectpicker" data-live-search="true" name="{{ $name }}" {{ $multiple ? 'multiple' : '' }}>
        <option value="">Nothing selected</option>
        @foreach($dataArray as $data)
            <option value="{{ $data->$dataValue }}" {{ $data->$dataValue == old($name) ? 'selected' : '' }}>{{ $data->$dataName }}</option>
        @endforeach
    </select>
    @if($errors->has($name))
        <p class="input-error">{{ $errors->first($name) }}</p>
    @endif
</div>
