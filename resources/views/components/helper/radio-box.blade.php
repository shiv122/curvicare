@props([
    'name' => '',
    'count' => 1,
    'value' => '',
    'text' => '',
])

@for ($i = 1; $i <= $count; $i++)
    <div class="px-2">
        <input type="radio" data-custom-chb="" id="cusotm_control_{{ $i }}" name="{{ $name }}"
            value="{{ $i }}">
        <label class="d-flex align-items-center justify-content-center" for="cusotm_control_{{ $i }}">
            <p>
                {{ $text }} {{ $i }}
            </p>
        </label>
    </div>
@endfor
