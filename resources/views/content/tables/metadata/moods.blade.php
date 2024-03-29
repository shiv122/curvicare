@extends('layouts/contentLayoutMaster')

@section('title', 'Moods')

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
    <x-side-modal title="Add mood" id="add-mood-modal">
        <x-form id="add-mood" method="POST" class="" :route="route('admin.metadata.mood.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="edit mood" id="edit-mood-modal">
        <x-form id="edit-mood" method="POST" class="" :route="route('admin.metadata.mood.update')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
                <x-input name="id" type="hidden" id="edit_id" />
            </div>
        </x-form>
    </x-side-modal>

@endsection
@section('vendor-script')
@endsection
@section('page-script')

    <script>
        $(document).ready(function() {
            $('#mood-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-mood-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
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
