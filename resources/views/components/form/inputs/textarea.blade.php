@props(['name', 'label' => null])
@php($label = $label ?? ucwords($name))

<div class="input-container">
    <div class="floating-label-container">
        <textarea class="form-control" rows="3" placeholder=" " name="{{ $name }}">{{ old($name) }}</textarea>
        <label class="form-label">{{ $label }}</label>
    </div>
</div>
