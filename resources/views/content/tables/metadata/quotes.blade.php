@extends('layouts/contentLayoutMaster')

@section('title', 'Quotes')
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
    <x-side-modal title="Add quote" id="add-quote-modal">
        <x-form id="add-quote" method="POST" class="" :route="route('admin.metadata.quote.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="quote" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input-file name="image" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-select name="moods" :multiple="true" :options="$moods" />
            </div>
        </x-form>
    </x-side-modal>

    <x-side-modal title="Edit quote" id="edit-quote-modal">
        <x-form id="edit-quote" method="POST" class="" :route="route('admin.metadata.quote.update')">
            <div class="col-md-12 col-12 ">
                <x-input name="quote" />
                <x-input name="id" type="hidden" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input-file attrs='data-hover="img"' name="image" />
                <div class="avatar avatar-sm mb-1">
                    <img src="" class="view-on-click quote-image" alt="avatar">
                </div>
            </div>
            <div class="col-md-12 col-12 ">
                <x-select name="mood" id="edit_mood" :options="$moods" />
            </div>
        </x-form>
    </x-side-modal>

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

        function setValue(data, modal) {
            $(`${modal} #edit_mood`).val(data.mood_id).trigger('change');
            $(`${modal} #quote`).val(data.quotes);
            $(`${modal} #id`).val(data.id);
            $(`${modal} .quote-image`).attr('src', '/' + data.image);
            $(modal).modal('show');
        }
    </script>
@endsection
