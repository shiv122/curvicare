@extends('layouts/contentLayoutMaster')

@section('title', 'Tickets')

@section('vendor-style')

@endsection
@section('page-style')
    <style>
        .question-holder {
            border: 2px dashed #cf1357;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('content')

    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>
                    {!! $dataTable->table() !!}
                </x-card>
            </div>
        </div>
    </section>

    <x-modal id="reply-ticket-modal" :footer="false" size="lg" title="Reply Ticket">
        <div class="row">
            <div class="col-12">
                <div class="question-holder">
                    <div class="question-section">

                    </div>
                </div>
                <form id="reply-form">
                    <div class="row">
                        <div class="col-12">
                            <x-input name="reply" type="textarea" />
                            <input type="hidden" hidden name="id" id="id">
                        </div>
                        <div class="col-12">
                            <x-select name="status" :options="['pending', 'resolved']" />
                        </div>
                        <div class="col-12 text-center mt-2">

                            <button type="submit" class="btn btn-success">Reply</button>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </x-modal>


@endsection
@section('vendor-script')
@endsection
@section('page-script')

    <script>
        $(document).ready(function() {
            $(document).on('click', '[data-reply]', function(e) {
                e.preventDefault();
                const data = $(this).data('reply');
                console.log(data);
                $('#reply-ticket-modal .question-section').html(data.description)
                $('#reply-ticket-modal #id').val(data.id)
                $('#reply-ticket-modal #status').val(data.status).trigger('change')
                $('#reply-ticket-modal').modal('show');

            });


            $('#reply-form').submit(function(e) {
                e.preventDefault();

                reboundForm({
                    'selector': '#reply-form',
                    'route': "{{ route('admin.ticket.reply') }}",
                    'successCallback': function() {
                        $('#reply-ticket-modal').modal('hide')
                    }
                });



            });
        });
    </script>
@endsection
