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
                    {!! $dataTable->table() !!}
                </x-card>
            </div>
        </div>
    </section>
    <x-side-modal title="Add Tag" id="add-tag-modal">
        <x-form id="add-tag" method="POST" class="" :route="route('admin.metadata.tag.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="Edit Tag" id="edit-tag-modal">
        <x-form id="edit-tag" method="POST" class="" :route="route('admin.metadata.tag.update')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
                <x-input name="id" id="edit_id" type="hidden" />
            </div>
        </x-form>
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

        function setValue(data, modal) {

            $(`${modal} #edit_id`).val(data.id);
            $(`${modal} #name`).val(data.name);
            $(modal).modal('show');
        }
    </script>
@endsection
