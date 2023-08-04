@extends('layouts/contentLayoutMaster')

@section('title', 'Assign Recipe')

@section('page-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
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
            bottom: -5px;
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

                    <div class="col-12 mt-5">
                        <div class="selector-container owl-carousel owl-theme">

                        </div>
                    </div>
                </x-card>
            </div>

            <div class="col-12">
                <x-card title="Recipe List">
                    <x-tab class="col-md-12 nav-vertical" innerClass="nav-left" :tabs="[
                        'early_morning',
                        'breakfast',
                        'mid_morning',
                        'pre_lunch',
                        'lunch',
                        'post_lunch',
                        'pre_snack',
                        'evening_snack',
                        'post_snack',
                        'pre_dinner',
                        'dinner',
                        'post_dinner',
                    ]" active="breakfast">

                        <x-slot name="early_morning">
                            <div class="row match-height w-md-90 mb-5" id="early_morning-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="early_morning"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Early Morning
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="breakfast">
                            <div class="row match-height w-md-90 mb-5" id="breakfast-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="breakfast"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Breakfast
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="mid_morning">
                            <div class="row match-height w-md-90 mb-5" id="mid_morning-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="mid_morning"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Mid Morning
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="pre_lunch">
                            <div class="row match-height w-md-90 mb-5" id="pre_lunch-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="pre_lunch"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Pre Lunch
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
                        <x-slot name="post_lunch">
                            <div class="row match-height w-md-90 mb-5" id="post_lunch-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="post_lunch"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Post Lunch
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
                        <x-slot name="evening_snack">
                            <div class="row match-height w-md-90 mb-5" id="evening_snack-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="evening_snack"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Evening Snack
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
                        <x-slot name="pre_dinner">
                            <div class="row match-height w-md-90 mb-5" id="pre_dinner-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="pre_dinner"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Pre Dinner
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="dinner">
                            <div class="row match-height w-md-90 mb-5" id="dinner-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="dinner"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Dinner
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="post_dinner">
                            <div class="row match-height w-md-90 mb-5" id="post_dinner-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="post_dinner"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Post Dinner
                                </button>
                            </div>
                        </x-slot>

                    </x-tab>
                </x-card>
            </div>
        </div>
    </section>



    <x-modal :footer="false" size="lg" id="add-meal" title="Add Meal">

        <x-form successCallback="refreshData" id="add-meal-form" :route="route('admin.template.assign-recipe')">
            <div class="col-md-12 col-12 ">
                <x-input type="textarea" name="recipe" />
                <input type="text" name="for" hidden>
                <input type="number" name="template" hidden>
                <input type="number" name="day" hidden>
            </div>
        </x-form>

    </x-modal>

    <x-modal :footer="false" size="lg" id="edit-meal" title="Edit Meal">

        <x-form successCallback="refreshData" btnText="Update" id="edit-meal-form" :route="route('admin.template.assign-recipe.update')">
            <div class="col-md-12 col-12 ">
                <input type="hidden" hidden name="id" id="id">
                <x-input type="textarea" name="details" :required="false" />
            </div>
        </x-form>

    </x-modal>

@endsection
@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        const arr = [
            'early_morning',
            'breakfast',
            'mid_morning',
            'pre_lunch',
            'lunch',
            'post_lunch',
            'pre_snack',
            'evening_snack',
            'post_snack',
            'pre_dinner',
            'dinner',
            'post_dinner',
        ];
        let temprary;
        $(document).on('click', '[data-target="#add-meal"]', function(e) {
            $('#add-meal input[name="for"]').val($(this).data('for'));
            $('#add-meal input[name="template"]').val($('#template').val());
            $('#add-meal input[name="day"]').val($('[data-custom-chb]:checked').val());
        });


        $(document).on('change', '#template', function(e) {
            $('.selector-container').html("");
            emptyRecipe();
            updateTabCount();
            e.preventDefault();
            var template_id = $(this).val();
            if (template_id === '' || template_id === null) {
                $('.btn-holder').addClass('d-none');
                $('#add-meal input[name="template"]').val('');
                return;
            }
            $('#add-meal input[name="template"]').val(template_id);
            fetchSelectorData(template_id);
        });


        $(document).on('change', '[data-custom-chb]', function(e) {
            e.preventDefault();
            const selected = $(this).val();
            const template_id = $('#template').val();
            $('#add-meal-form input[name="day"]').val(selected);
            fetchMealData(template_id, selected);
        });



        function fetchSelectorData(template_id) {
            reboundForm({
                data: {
                    template_id: template_id
                },
                notification: false,
                processData: true,
                route: "{{ route('admin.template.get-days') }}",
                type: "GET",
                successCallback: function(response) {
                    const container = $('.selector-container');
                    container.html(response.selector_html);
                    if (container.hasClass('owl-carousel')) {
                        container.trigger('destroy.owl.carousel');
                    }

                    container.owlCarousel({
                        loop: false,
                        margin: 0,
                        nav: false,
                        stagePadding: 50,

                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 3
                            },
                            1000: {
                                items: 5
                            }
                        }
                    })

                },
                errorCallback: function(response) {
                    console.log(response);
                }
            });
        }


        function fetchMealData(template_id, day) {
            console.log('fetchMealData Called from :', arguments.callee.caller.name);
            reboundForm({
                data: {
                    template_id: template_id,
                    day: day
                },
                notification: false,
                processData: true,
                route: "{{ route('admin.template.get-assignments') }}",
                type: "GET",
                successCallback: function(response) {
                    // $('#breakfast-data').html(response.breakfast);
                    // $('#lunch-data').html(response.lunch);
                    // $('#dinner-data').html(response.dinner);
                    // $('#post_snack-data').html(response.post_snack);
                    // $('#pre_snack-data').html(response.pre_snack);
                    temprary = response;

                    arr.forEach((item) => {

                        $(`#${item}-data`).html(response[item]);
                    });

                    $('.btn-holder').removeClass('d-none');
                    setTimeout(() => {
                        updateTabCount();
                    }, 10);
                },
                errorCallback: function(response) {
                    console.log(response);
                }
            })
        }

        function refreshData() {
            const template_id = $('#template').val();
            const day = $('[data-custom-chb]:checked').val();
            fetchMealData(template_id, day);
        }

        function recipeAssignmentDeleted(data) {
            const template_id = $('#template').val();
            const day = $('[data-custom-chb]:checked').val();
            console.log(data);
            fetchMealData(template_id, day);
        }


        function emptyRecipe() {
            const error_html = `
                            <div class="col-md-12 col-12">
                                <div class="col-12">
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <div class="alert-body">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                ×</button>
                                            <span class="glyphicon glyphicon-ok"></span> <strong>Info Message</strong>
                                            <hr class="message-inner-separator">
                                            <p>
                                            Select a template and day or week to see the recipes assigned to it.    
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            arr.forEach((item) => {
                $(`#${item}-data`).html(error_html);
            })
        }

        function updateTabCount() {
            arr.forEach((item) => {
                const count = $(`#${item}-data .recipe-holder`).length;
                appentBadge($(`#${item}-tab-fill`), count);
            })
        }

        function appentBadge(element, count) {

            if (element.find('.badge').length > 0) {
                element.find('.badge').text(count);
            } else {
                element.prepend(`<span class="badge badge-pill badge-primary mr-1">${count}</span>`);
            }

        }
    </script>

    <script>
        $(document).on('click', '[data-edit-meal]', function(e) {
            e.preventDefault();
            const data = $(this).data('edit-meal');
            console.log(data);
            $('#edit-meal #id').val(data.id);
            $('#edit-meal #details').val(data.extra);
            $('#edit-meal').modal('show');
        });
    </script>

@endsection
