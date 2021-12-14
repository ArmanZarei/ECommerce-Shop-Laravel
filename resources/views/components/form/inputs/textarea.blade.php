@props(['name', 'label' => null, 'value' => null])
@php($label = $label ?? ucwords($name))
@php($errorKey = $errorKey ?? $name)

<div class="input-container">
    <div class="floating-label-container">
        <textarea class="form-control {{ $errors->has($errorKey) ? 'has-error' : '' }}" rows="3" placeholder=" " name="{{ $name }}">{{ old($name) ?? $value }}</textarea>
        <label class="form-label">{{ $label }}</label>
    </div>
    @if($errors->has($errorKey))
        <p class="input-error">{{ $errors->first($errorKey) }}</p>
    @endif
</div>
