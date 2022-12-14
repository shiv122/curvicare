@extends('layouts/contentLayoutMaster')

@section('title', 'Faq')
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
    <x-side-modal size="xl" title="Add faq" id="add-faq-modal">
        <x-form id="add-faq" method="POST" class="" :route="route('admin.faq.store')">
            <div class="col-md-12 col-12 ">
                <x-select name="category" :options="$faq_cats" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="question" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="answer" type="textarea" />
            </div>

        </x-form>
    </x-side-modal>

    <x-side-modal title="Edit faq" id="edit-faq-modal">
        <x-form id="edit-faq" method="POST" class="" :route="route('admin.faq.update')">
            <div class="col-md-12 col-12 ">
                <x-input name="question" />
                <x-input name="id" type="hidden" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="answer" type="textarea" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-select id="edit_category" name="category" :options="$faq_cats" />
            </div>
        </x-form>
    </x-side-modal>

@endsection
@section('page-script')

    <script>
        $(document).ready(function() {
            $('#faq-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-faq-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );

            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });

        function setValue(data, modal) {
            $(`${modal} #question`).val(data.question);
            $(`${modal} #answer`).text(data.answer);
            $(`${modal} #edit_category`).val(data.faq_category_id).trigger('change');
            $(`${modal} #id`).val(data.id);
            $(modal).modal('show');
        }
    </script>
@endsection
