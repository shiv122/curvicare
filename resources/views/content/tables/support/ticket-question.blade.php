@extends('layouts/contentLayoutMaster')

@section('title', 'Ticket Question')

@section('vendor-style')

@endsection
@section('page-style')
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

    <x-side-modal title="Add ticket question" id="add-ticket-question-modal">
        <x-form id="add-ticket-question" method="POST" class="" :route="route('admin.ticket.question.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="question" type="textarea" />
            </div>

        </x-form>
    </x-side-modal>
    <x-side-modal title="edit ticket question" id="edit-ticket-question-modal">
        <x-form id="edit-ticket-question" method="POST" class="" :route="route('admin.ticket.question.update')">
            <div class="col-md-12 col-12 ">
                <x-input name="question" type="textarea" />
                <input type="hidden" name="id" id="id">
            </div>

        </x-form>
    </x-side-modal>
@endsection
@section('vendor-script')
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $('#ticket-question-table_wrapper .dt-buttons').append(
                `<button type="button" data-toggle="modal" data-target="#add-ticket-question-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );
        });


        function setValue(data, modal) {
            $(`${modal} #id`).val(data.id);
            $(`${modal} #question`).text(data.question);
            $(modal).modal('show');
        }
    </script>
@endsection
