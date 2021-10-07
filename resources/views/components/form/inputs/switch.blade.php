@props(['name', 'label' => null, 'checked' => true])
@php($label = $label ?? ucwords($name))

<div class="d-flex align-items-center">
    <span class="me-3 ms-1">{{ $label }}</span>
    <input type="checkbox" class="ios-button" name="{{ $name }}" {{ $checked ? 'checked' : '' }}>
</div>
