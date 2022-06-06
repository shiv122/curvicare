<div class="form-group {{ $parentClass }} text-left">
    <label for="{{ $name }}">{{ Str::ucfirst(Str::replace('_', ' ', $name)) }}</label>
    @if ($type == 'textarea')
        <textarea @if ($required) required @endif {!! $attrs !!} class="form-control"
            id="{{ $name }}" name="{{ $name }}" rows="3">{{ $value }}</textarea>
        @if (!empty($helperText))
            <p><small class="text-muted">{{ $helperText }}</small></p>
        @endif
        <div class="invalid-tooltip">Please provide a valid {{ Str::ucfirst(Str::replace('_', ' ', $name)) }}</div>
    @else
        <input value="{{ $value }}" type="{{ $type }}" class="form-control {{ $class }}"
            @if ($required) required @endif name="{{ $name }}" {!! $attrs !!}
            id="{{ $name }}" placeholder="Enter {{ Str::replace('_', ' ', $name) }}">
        @if (!empty($helperText))
            <p><small class="text-muted">{{ $helperText }}</small></p>
        @endif
        <div class="invalid-tooltip">Please provide a valid {{ Str::ucfirst(Str::replace('_', ' ', $name)) }}</div>

    @endif

</div>
