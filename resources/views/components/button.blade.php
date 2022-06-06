<button @if ($isSubmit) type="submit" @else type="button" @endif {!! $attrs !!}
    class="btn btn-{{ $type ?? 'primary' }} waves-effect waves-float waves-light {{ $class }}">
    {{ $text }} {{ $icon }}
</button>
