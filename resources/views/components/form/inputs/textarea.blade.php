@props(['name', 'label' => null, 'value' => null])
@php($label = $label ?? ucwords($name))

<div class="input-container">
    <div class="floating-label-container">
        <textarea class="form-control" rows="3" placeholder=" " name="{{ $name }}">{{ old($name) ?? $value }}</textarea>
        <label class="form-label">{{ $label }}</label>
    </div>
</div>
