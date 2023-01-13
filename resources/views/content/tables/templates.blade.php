@extends('layouts/contentLayoutMaster')

@section('title', 'Templates')

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


    <x-side-modal title="Add template" id="add-template-modal">
        <x-form id="add-template" method="POST" class="" :route="route('admin.template.store')">
            <div class=" col-12 ">
                <x-input name="name" />
            </div>
            <div class=" col-12 ">
                <x-select name="type" :options="['daily', 'weekly']" />
            </div>
            <div class=" col-12 ">
                <x-input name="days" type="number" label="Number of days" />
            </div>




        </x-form>
    </x-side-modal>


    <x-side-modal title="Edit template" id="edit-template-modal">
        <x-form id="edit-template" method="POST" class="" :route="route('admin.template.update')">
            <div class=" col-12 ">
                <x-input name="name" />
                <x-input name="id" type="hidden" />
            </div>
            <div class=" col-12 ">
                <x-input name="days" type="number" />
            </div>
            <div class=" col-12 ">
                <x-select name="type" id="edit-type" :options="['daily', 'weekly']" />
            </div>

        </x-form>
    </x-side-modal>



@endsection
@section('vendor-script')
@endsection
@section('page-script')

    <script>
        $(document).ready(function() {
            $('#template-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-template-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );
            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });


        function setValue(data, modal) {
            $(`${modal} input[name="id"]`).val(data.id);
            $(`${modal} input[name="name"]`).val(data.name);
            $(`${modal} input[name="days"]`).val(data.days);
            $(`${modal} select[name="type"]`).val(data.type).change();
            $(`${modal}`).modal('show');
        }
    </script>
@endsection
