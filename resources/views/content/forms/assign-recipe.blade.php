@extends('layouts/contentLayoutMaster')

@section('title', 'Assign Recipe')

@section('page-style')
    <style>
        .recipe-holder {
            display: flex;
            gap: 1rem;
            border: 1px solid #c0bfc5;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
            padding: 1rem;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
        }

        .dark-layout .recipe-holder {
            border: 1px solid #404656;
        }

        .recipe-image img {
            max-width: 10rem;
            border-radius: 5px;
            width: -webkit-fill-available;
        }

        .recipe-action {
            position: absolute;
            right: 0;
            bottom: 0;
            padding: 1rem;
        }

        .recipe-info {
            flex: 1;
            padding: 0.5rem;
        }

        @media (min-width: 768px) {
            .w-md-90 {
                width: 90% !important;
            }
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
                    <x-tab class="col-md-12 nav-vertical" innerClass="nav-left" :tabs="['breakfast', 'lunch', 'post_snack', 'pre_snack', 'dinner']" active="breakfast">
                        <x-slot name="breakfast">
                            <div class="row match-height w-md-90 mb-5" id="breakfast-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="breakfast"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Breakfast
                                </button>
                            </div>
                        </x-slot>

                        <x-slot name="lunch">
                            <div class="row match-height w-md-90 mb-5" id="lunch-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="lunch" data-toggle="modal"
                                    data-target="#add-meal">
                                    Add Lunch
                                </button>
                            </div>
                        </x-slot>

                        <x-slot name="dinner">
                            <div class="row match-height w-md-90 mb-5" id="dinner-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="dinner" data-toggle="modal"
                                    data-target="#add-meal">
                                    Add Dinner
                                </button>
                            </div>
                        </x-slot>


                        <x-slot name="post_snack">
                            <div class="row match-height w-md-90 mb-5" id="post_snack-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="post_snack"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Post Snack
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="pre_snack">
                            <div class="row match-height w-md-90 mb-5" id="pre_snack-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="pre_snack"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Pre Snack
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
            $('#add-meal input[name="template"]').val($('#template').val());
        });


        $(document).on('change', '#template', function(e) {
            e.preventDefault();
            var template_id = $(this).val();
            if (template_id === '' || template_id === null) {
                $('.btn-holder').addClass('d-none');
                $('#add-meal input[name="template"]').val('');
                return;
            }
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
                    console.log(response);
                    $('#breakfast-data').html(response.breakfast);
                    $('#lunch-data').html(response.lunch);
                    $('#dinner-data').html(response.dinner);
                    $('#post_snack-data').html(response.post_snack);
                    $('#pre_snack-data').html(response.pre_snack);
                    $('.btn-holder').removeClass('d-none');
                },
                errorCallback: function(response) {
                    console.log(response);
                }
            })
        }

        function mealAdded() {
            const template_id = $('#template').val();
            fetchMealData(template_id);
        }

        function recipeAssignmentDeleted(data) {
            const template_id = $('#template').val();
            console.log(data);
            fetchMealData(template_id);
        }
    </script>

@endsection
