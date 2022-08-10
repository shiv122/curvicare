{!! $prepend ?? '' !!}
<button type="button"
    @if (!empty($data)) @forelse ($data as $key=> $d) {{ 'data-' . $key . '=' . $d }}
@empty @endforelse @endif
    class="btn {{ $class ?? 'btn-flat-success' }} waves-effect">
    {{ $text ?? '' }} {!! $icon ?? '' !!}
</button>
