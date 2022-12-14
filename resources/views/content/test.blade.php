@extends('layouts/contentLayoutMaster')

@section('title', 'Add blog')

@section('page-style')
@endsection

@section('content')
    <section>
        <div class="row match-height">

            <div class="col-12">
                <x-card>
                    <div class="row">
                        <div class="col-md-6">
                            <button data-id="6" class="btn btn-block btn-success">Send to ketan</button>
                        </div>
                        <div class="col-md-6">
                            <button data-id="1" class="btn btn-block btn-success">Send to Admin</button>
                        </div>
                    </div>
                </x-card>
            </div>

        </div>
    </section>


@endsection
@section('page-script')


    <script>
        window.me = '{{ auth()->user()->id }}';
        $(document).on('click', '.btn-success', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route('send') }}',
                type: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
    <script src="{{ asset(mix('js/chat.js')) }}"></script>
@endsection
