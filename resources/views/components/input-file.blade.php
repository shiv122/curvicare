<div class="form-group {{ $parentClass }}">
    @if ($hasLabel)
        <label for="{{ $name }}">{{ Str::ucfirst(Str::replace('_', ' ', $name)) }}</label>
    @endif
    <div class="custom-file">
        <input type="file"
            @if ($multiple) multiple name="{{ $name }}[]" @else name="{{ $name }}" @endif
            {!! $attrs !!} class="custom-file-input {{ $class }}" id="{{ $name }}">
        <label class="custom-file-label" for="{{ $name }}">Choose
            {{ Str::ucfirst(Str::replace('_', ' ', $name)) }}</label>
        <div class="invalid-tooltip">Please provide a valid {{ Str::ucfirst(Str::replace('_', ' ', $name)) }}</div>
    </div>

</div>
