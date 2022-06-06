<form class="needs-validation {{ $class }}" id="{{ $id }}" novalidate="">
    <div class="form-row">
        {{ $form }}
    </div>
    <div class="col-12 mt-3 text-center">
        <x-button :isSubmit="true" :text="$btnText" />

    </div>
</form>


@push('component-script')
    <script>
        $(document).on('submit', '#{{ $id }}', function(e) {
            e.preventDefault();
            let valid = true;
            if (!validate($(this))) {
                return false;
            }
            $('[required]').each(function() {
                if ($(this).is(':invalid') || !$(this).val()) snb('error', 'Validation Error', $(this)
                    .closest('.form-group').find('.invalid-tooltip').text(), valid = false);
            })
            if (!valid) return false;
            reboundForm({
                selector: this,
                route: "{{ $route }}",
                method: "POST",
            })
        });
    </script>
@endpush
