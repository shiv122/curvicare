<form class="needs-validation {{ $class }}" id="{{ $id }}" novalidate="">
    <div class="form-row">
        {{ $form }}
    </div>
    <div class="col-12 mt-3 text-center">
        <x-button :isSubmit="true" :text="$btnText" />

    </div>
</form>

@php
if ($reload) {
    $rld = 1;
} else {
    $rld = 0;
}
@endphp
@push('component-script')
    <script>
        $(document).on('submit', '#{{ $id }}', function(e) {
            e.preventDefault();
            let valid = true;
            if (!validate($(this))) {
                return false;
            }
            $('[required]:not(:disabled)').each(function() {
                if ($(this).is(':invalid') || !$(this).val()) snb('error', 'Validation Error', $(this)
                    .closest('.form-group').find('.invalid-tooltip').text(), valid = false);
            })
            if (!valid) return false;
            reboundForm({
                selector: this,
                route: "{{ $route }}",
                method: "POST",
                reset: {{ $reset }},
                relaod: {{ $rld }},
            })
        });
    </script>
@endpush
