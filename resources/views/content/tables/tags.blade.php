@extends('layouts/contentLayoutMaster')

@section('title', 'Tags')

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
    <x-side-modal title="Add Tag" id="add-tag-modal">
        <x-slot name="modal_body">
            <x-form id="add-tag" method="POST" class="" :route="route('admin.metadata.tag.store')">
                <x-slot name="form">
                    <div class="col-md-12 col-12 ">
                        <x-input attrs="required" name="name" />
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
            $('#tag-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-tag-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );

            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });
    </script>
@endsection
