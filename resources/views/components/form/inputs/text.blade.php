@props(['name', 'value' => null, 'type' => 'text', 'label' => null, 'errorKey' => null])
@php($label = $label ?? ucwords($name))
@php($errorKey = $errorKey ?? $name)

<div class="input-container">
    <div class="floating-label-container">
        <input type="{{ $type }}" name="{{ $name }}" autocomplete="off" placeholder=" " class="{{ $errors->has($errorKey) ? 'has-error' : '' }}" value="{{ old($name) ?? $value }}">
        <label>{{ $label }}</label>
    </div>
    @if($errors->has($errorKey))
        <p class="input-error">{{ $errors->first($errorKey) }}</p>
    @endif
</div>

