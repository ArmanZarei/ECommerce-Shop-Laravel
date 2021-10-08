@props(['action', 'method' => 'POST'])

<form action="{{ $action }}" method="POST" class="{{ $attributes->class(['custom-form'])->get('class') }}" {{ $attributes->except('class') }}>
    @if(strtoupper($method) != 'POST')
        @method($method)
    @endif
    @csrf
    {{ $slot }}
</form>
