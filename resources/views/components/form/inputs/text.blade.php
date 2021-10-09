@props(['name', 'value' => null, 'type' => 'text', 'label' => null])
@php($label = $label ?? ucwords($name))

<div class="input-container">
    <div class="floating-label-container">
        <input type="{{ $type }}" name="{{ $name }}" autocomplete="off" placeholder=" " class="{{ $errors->has($name) ? 'has-error' : '' }}" value="{{ $value ?? old($name) }}">
        <label>{{ $label }}</label>
    </div>
    @if($errors->has($name))
        <p class="input-error">{{ $errors->first($name) }}</p>
    @endif
</div>

