@props(['name', 'dataArray', 'multiple' => false, 'dataValue' => 'id', 'dataName' => 'name', 'label' => null])
@php($label = $label ?? ucwords($name))

<div class="input-select-container position-relative {{ $errors->has($name) ? 'has-error' : '' }}">
    <span class="custom-span-input-label">{{ $label }}</span>
    <select class="selectpicker" data-live-search="true" name="{{ $name }}" {{ $multiple ? 'multiple' : '' }}>
        @unless($multiple)
            <option value="">Nothing selected</option>
        @endunless
        @foreach($dataArray as $data)
            @php($isSelected = $multiple ? in_array(strval($data->$dataValue), old(rtrim($name, "[]")) ?? []) : $data->$dataValue == old($name))
            <option value="{{ $data->$dataValue }}" {{ $isSelected ? 'selected' : '' }}>{{ $data->$dataName }}</option>
        @endforeach
    </select>
    @if($errors->has($name))
        <p class="input-error">{{ $errors->first($name) }}</p>
    @endif
</div>
