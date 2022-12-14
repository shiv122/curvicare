@extends('layouts/contentLayoutMaster')

@section('title', 'Faq Categories')
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
    <x-side-modal title="Add faq category" id="add-faq-category-modal">
        <x-form id="add-faq-category" method="POST" class="" :route="route('admin.faq.categories.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
            </div>

        </x-form>
    </x-side-modal>

    <x-side-modal title="Edit faq category" id="edit-faq-category-modal">
        <x-form id="edit-faq-category" method="POST" class="" :route="route('admin.faq.categories.update')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
                <x-input name="id" type="hidden" />
            </div>

        </x-form>
    </x-side-modal>

@endsection
@section('page-script')

    <script>
        $(document).ready(function() {
            $('#faq-category-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-faq-category-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );

            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });

        function setValue(data, modal) {
            $(`${modal} #name`).val(data.name);
            $(`${modal} #id`).val(data.id);
            $(modal).modal('show');
        }
    </script>
@endsection
