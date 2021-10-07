@props(['action', 'method' => 'POST'])

<form action="{{ $action }}" method="POST" class="custom-form">
    @if(strtoupper($method) != 'POST')
        @method($method)
    @endif
    @csrf
    {{ $slot }}
</form>
