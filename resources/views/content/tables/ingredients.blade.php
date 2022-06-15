@extends('layouts/contentLayoutMaster')

@section('title', 'Ingredients')
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
    <x-side-modal title="Add ingredient" id="add-ingredient-modal">
        <x-slot name="modal_body">
            <x-form id="add-ingredient" method="POST" class="" successCallback="append" :route="route('admin.ingredient.store')">
                <x-slot name="form">
                    <div class="col-md-12 col-12 ">
                        <x-select attrs="required" name="name" optionValue="name" :options="$baseIngredient" />
                    </div>
                    <div class="col-md-12 col-12 ">
                        <x-input-file attrs='required accept="image/*"' name="image" />
                    </div>
                    <div class="col-md-12 col-12 ">
                        <x-input :required="false" type="textarea" name="description" />
                    </div>
                    <div class="col-md-12 col-12 ">
                        <x-input :required="false" type="textarea" name="caution" />
                    </div>
                </x-slot>
            </x-form>
        </x-slot>
    </x-side-modal>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $('#ingredient-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-ingredient-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );

            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });
        $("#name").select2({
            tags: true
        });
        var test;

        function append() {
            test = arguments;
            const new_ingredients = arguments[0].new_ingredient;
            if (new_ingredients) {
                var data = {
                    id: new_ingredients,
                    text: new_ingredients
                };
                var newOption = new Option(data.text, data.id, false, false);
                $('#name').append(newOption).trigger('change');
            }
        }
    </script>
@endsection
