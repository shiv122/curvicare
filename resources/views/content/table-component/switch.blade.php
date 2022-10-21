@php
    if (empty($column)) {
        $status = $data->status == 'active' ? 'checked' : '';
    } else {
        $status = $data->$column == $checked_value ? 'checked' : '';
    }
@endphp
<div class="custom-control custom-control-success custom-switch">
    <input data-block="tr" data-route="{{ $route }}" value="{{ $data->id }}" type="checkbox" {{ $status }}
        class="custom-control-input status-switch {{ $class ?? '' }}"
        id="switch-{{ $column ?? 'default' }}-{{ $id ?? '' }}{{ $data->id }}">
    <label class="custom-control-label"
        for="switch-{{ $column ?? 'default' }}-{{ $id ?? '' }}{{ $data->id }}"></label>
</div>
