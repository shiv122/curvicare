@extends('layouts/contentLayoutMaster')

@section('title', 'Quotes')

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
                    <x-slot name="card_body">
                        {!! $dataTable->table() !!}
                    </x-slot>
                </x-card>
            </div>
        </div>
    </section>
    <x-side-modal title="Add quote" id="add-quote-modal">
        <x-slot name="modal_body">
            <x-form id="add-quote" method="POST" class="" :route="route('admin.metadata.quote.store')">
                <x-slot name="form">
                    <div class="col-md-12 col-12 ">
                        <x-input name="quote" />
                    </div>
                    <div class="col-md-12 col-12 ">
                        <x-input-file name="image" />
                    </div>
                    <div class="col-md-12 col-12 ">
                        <x-select name="moods" :multiple="true" :options="$moods" />
                    </div>
                </x-slot>
            </x-form>
        </x-slot>
    </x-side-modal>

@endsection
@section('vendor-script')
@endsection
@section('page-script')

    <script>
        $(document).ready(function() {
            $('#quote-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-quote-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );

            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });
    </script>
@endsection
