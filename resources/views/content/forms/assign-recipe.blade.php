@extends('layouts/contentLayoutMaster')

@section('title', 'Assign Recipe')

@section('page-style')
    <style>
        .recipe-holder {
            display: flex;
            gap: 1rem;
            border: 1px solid #404656;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }

        .recipe-image img {
            max-width: 10rem;
        }

        .recipe-action {
            position: absolute;
            right: 0;
            bottom: 0;
            padding: 5px;
        }

        .recipe-info {
            flex: 1;
            padding: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Assign Recipe">

                    <div class="col-md-12 col-12 ">
                        <x-select name="template" :options="$templates" label="Select template to get the assigned recipes" />
                    </div>
                </x-card>
            </div>

            <div class="col-12">
                <x-card title="Recipe List">
                    <x-tab class="col-md-12 nav-vertical" innerClass="nav-left" :tabs="['breakfast', 'lunch', 'dinner']" active="breakfast">
                        <x-slot name="breakfast">
                            <div class="d-flex mb-5" id="breakfast-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="breakfast"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Breakfast
                                </button>
                            </div>
                        </x-slot>

                        <x-slot name="lunch">
                            <div class="d-flex mb-5" id="lunch-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="lunch" data-toggle="modal"
                                    data-target="#add-meal">
                                    Add Lunch
                                </button>
                            </div>
                        </x-slot>

                        <x-slot name="dinner">
                            <div class="d-flex mb-5" id="dinner-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="dinner" data-toggle="modal"
                                    data-target="#add-meal">
                                    Add Dinner
                                </button>
                            </div>
                        </x-slot>
                    </x-tab>
                </x-card>
            </div>
        </div>
    </section>



    <x-side-modal :footer="false" size="lg" id="add-meal" title="Add Meal">

        <x-form successCallback="mealAdded" id="add-meal-form" :route="route('admin.template.assign-recipe')">
            <div class="col-md-12 col-12 ">
                <x-select :multiple="true" name="recipes" :options="$recipes" />
                <input type="text" name="for" hidden>
                <input type="number" name="template" hidden>
            </div>
        </x-form>

    </x-side-modal>

@endsection
@section('page-script')

    <script>
        $(document).on('click', '[data-target="#add-meal"]', function(e) {
            $('#add-meal input[name="for"]').val($(this).data('for'));
        });


        $(document).on('change', '#template', function(e) {
            e.preventDefault();
            var template_id = $(this).val();
            if (template_id === '' || template_id === null) {
                $('.btn-holder').addClass('d-none');
                $('#add-meal input[name="template"]').val('');
                return;
            }

            blockDiv('.nav-vertical');
            $('#add-meal input[name="template"]').val(template_id);
            fetchMealData(template_id);
        });


        function fetchMealData(template_id) {
            reboundForm({
                data: {
                    template_id: template_id
                },
                notification: false,
                processData: true,
                route: "{{ route('admin.template.get-assignments') }}",
                type: "GET",
                successCallback: function(response) {
                    unblockDiv('.nav-vertical');
                    console.log(response);
                    $('#breakfast-data').html(response.breakfast);
                    $('#lunch-data').html(response.lunch);
                    $('#dinner-data').html(response.dinner);
                    $('.btn-holder').removeClass('d-none');
                },
                errorCallback: function(response) {
                    unblockDiv('.nav-vertical');
                    console.log(response);
                }
            })
        }

        function mealAdded() {
            const template_id = $('#template').val();
            fetchMealData(template_id);
        }
    </script>

@endsection
