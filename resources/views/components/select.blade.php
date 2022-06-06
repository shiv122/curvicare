<div class="form-group">
    <label for="{{ $name }}">{{ Str::ucfirst(Str::replace('_', ' ', $name)) }}</label>

    <select @if ($required) required @endif {{ $multiple }}
        class="select2  form-control {{ $class }}" id="{{ $name }}" {!! $attrs !!}
        @if ($multiple == 'true') multiple
            name="{{ $name }}[]"
        @else
            name="{{ $name }}" @endif>
        @if ($multiple !== 'true')
            <option selected disabled>Select {{ Str::ucfirst(Str::replace('_', ' ', $name)) }}</option>
        @endif

        @forelse ($options as $option)
            <option value="{{ $option->id }}">
                {{ $option->name }}
            </option>
        @empty
        @endforelse

    </select>
    <div class="invalid-tooltip">Please provide a valid {{ Str::ucfirst(Str::replace('_', ' ', $name)) }}</div>
</div>
