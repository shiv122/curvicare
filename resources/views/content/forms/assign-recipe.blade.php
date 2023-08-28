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
            padding: 1.5rem 1rem;
            /* box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset; */
        }

        #assignment-list .recipe-holder {
            margin-top: 1rem;
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

                    <input type="hidden" id="template_data_id" name="template_data_id"
                        value="{{ Request()->template_id ?? '' }}">


                    <div class="col-12 mt-5">
                        <div class="selector-container owl-carousel owl-theme">

                        </div>
                    </div>
                </x-card>
            </div>

            <div class="col-12">

                <x-card class=" position-relative" title="Recipe List">
                    <a type="button" id="create_pdf" style="right: 10px;top:10px;"
                        class="btn p-0 btn-sm btn-info position-absolute" href="#" title="Pdf Download"><svg
                            width="40" height="30" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.5 6.5V6H2v.5h.5Zm4 0V6H6v.5h.5Zm0 4H6v.5h.5v-.5Zm7-7h.5v-.207l-.146-.147l-.354.354Zm-3-3l.354-.354L10.707 0H10.5v.5ZM2.5 7h1V6h-1v1Zm.5 4V8.5H2V11h1Zm0-2.5v-2H2v2h1Zm.5-.5h-1v1h1V8Zm.5-.5a.5.5 0 0 1-.5.5v1A1.5 1.5 0 0 0 5 7.5H4ZM3.5 7a.5.5 0 0 1 .5.5h1A1.5 1.5 0 0 0 3.5 6v1ZM6 6.5v4h1v-4H6Zm.5 4.5h1v-1h-1v1ZM9 9.5v-2H8v2h1ZM7.5 6h-1v1h1V6ZM9 7.5A1.5 1.5 0 0 0 7.5 6v1a.5.5 0 0 1 .5.5h1ZM7.5 11A1.5 1.5 0 0 0 9 9.5H8a.5.5 0 0 1-.5.5v1ZM10 6v5h1V6h-1Zm.5 1H13V6h-2.5v1Zm0 2H12V8h-1.5v1ZM2 5V1.5H1V5h1Zm11-1.5V5h1V3.5h-1ZM2.5 1h8V0h-8v1Zm7.646-.146l3 3l.708-.708l-3-3l-.708.708ZM2 1.5a.5.5 0 0 1 .5-.5V0A1.5 1.5 0 0 0 1 1.5h1ZM1 12v1.5h1V12H1Zm1.5 3h10v-1h-10v1ZM14 13.5V12h-1v1.5h1ZM12.5 15a1.5 1.5 0 0 0 1.5-1.5h-1a.5.5 0 0 1-.5.5v1ZM1 13.5A1.5 1.5 0 0 0 2.5 15v-1a.5.5 0 0 1-.5-.5H1Z" />
                        </svg></a>
                    <button type="button" data-toggle="modal" data-target="#assignment-list" style="right: 80px;top:10px;"
                        class="btn btn-sm btn-info position-absolute">Preview</button>
                    <x-tab class="col-md-12 nav-vertical" innerClass="nav-left" :tabs="[
                        'early_morning',
                        'breakfast',
                        'mid_morning',
                        'pre_lunch',
                        'lunch',
                        'post_lunch',
                        'evening_snack',
                        'pre_dinner',
                        'dinner',
                        'post_dinner',
                        'pre_workout',
                        'post_workout',
                    ]" active="early_morning">

                        <x-slot name="early_morning">
                            <div class="row match-height mr-0 mb-5" id="early_morning-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="early_morning"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Early Morning
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="breakfast">
                            <div class="row match-height mr-0 mb-5" id="breakfast-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="breakfast"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Breakfast
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="mid_morning">
                            <div class="row match-height mr-0 mb-5" id="mid_morning-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="mid_morning"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Mid Morning
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="pre_lunch">
                            <div class="row match-height mr-0 mb-5" id="pre_lunch-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="pre_lunch"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Pre Lunch
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="lunch">
                            <div class="row match-height mr-0 mb-5" id="lunch-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="lunch" data-toggle="modal"
                                    data-target="#add-meal">
                                    Add Lunch
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="post_lunch">
                            <div class="row match-height mr-0 mb-5" id="post_lunch-data"></div>
                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="post_lunch"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Post Lunch
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="pre_snack">
                            <div class="row match-height mr-0 mb-5" id="pre_snack-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="pre_snack"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Pre Snack
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="evening_snack">
                            <div class="row match-height mr-0 mb-5" id="evening_snack-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="evening_snack"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Evening Snack
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="post_snack">
                            <div class="row match-height mr-0 mb-5" id="post_snack-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="post_snack"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Post Snack
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="pre_dinner">
                            <div class="row match-height mr-0 mb-5" id="pre_dinner-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="pre_dinner"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Pre Dinner
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="dinner">
                            <div class="row match-height mr-0 mb-5" id="dinner-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="dinner"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Dinner
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="post_dinner">
                            <div class="row match-height mr-0 mb-5" id="post_dinner-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="post_dinner"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Post Dinner
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="pre_workout">
                            <div class="row match-height mr-0 mb-5" id="pre_workout-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="pre_workout"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Pre Workout
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="post_workout">
                            <div class="row match-height mr-0 mb-5" id="post_workout-data"></div>

                            <div class="btn-holder d-none text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-for="post_workout"
                                    data-toggle="modal" data-target="#add-meal">
                                    Add Post Workout
                                </button>
                            </div>
                        </x-slot>

                    </x-tab>
                    <x-form successCallback="resetData" id="add-guideline-form" :route="route('admin.template.add-guideline')">

                        <div class="col-lg-12">
                            {{-- <x-input name="guideline" type="textarea" /> --}}
                            <x-editor name="guideline" />

                            <x-input name="guideline_template_id" type="hidden" />

                        </div>
                    </x-form>

                </x-card>

            </div>
        </div>
    </section>

    <x-modal size="xl" id="assignment-list" name="assignment-list">
        <div id="assignment-list-data" class="row">

        </div>

    </x-modal>

    <x-modal :footer="false" size="lg" id="add-meal" title="Add Meal">

        <x-form successCallback="refreshData" id="add-meal-form" :route="route('admin.template.assign-recipe')">
            <div class="col-md-12 col-12 ">
                <x-editor name="recipe" />
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
                <x-editor name="details" />
            </div>
        </x-form>

    </x-modal>

@endsection
@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            var tem_id = $('#template_data_id').val();
            $('#template').val(tem_id).trigger('change');

        });
        const arr = [
            'early_morning',
            'breakfast',
            'mid_morning',
            'pre_lunch',
            'lunch',
            'post_lunch',
            'evening_snack',
            'pre_dinner',
            'dinner',
            'post_dinner',
            'pre_workout',
            'post_workout',
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
            $('#guideline_template_id').val(template_id);

            fetchSelectorData(template_id);
        });


        $(document).on('change', '[data-custom-chb]', function(e) {
            e.preventDefault();
            const selected = $(this).val();
            const template_id = $('#template').val();
            $('#add-meal-form input[name="day"]').val(selected);
            $('#guideline_template_id').val(selected);

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


                    // $('#guideline').text(response.guideline)
                    // $('#guideline').text(response.guideline)

                    fullEditor_guideline.root.innerHTML = response.guideline;




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


        // function createPDF() {
        //     const template_id = $('#template').val();
        //     const day = $('[data-custom-chb]:checked').val();
        //     $.ajax({
        //         type: "GET",
        //         url: "{{ route('admin.template.createPDF') }}",
        //         success: function(response) {

        //         }
        //     });
        // }


        function fetchMealData(template_id, day) {
            console.log('fetchMealData Called from :', arguments.callee.caller.name);
            $('#create_pdf').attr('href', "{{ route('admin.template.createPDF') }}?template_id=" + template_id + "&day=" +
                day);
            $('#guideline_template_id').val(template_id);
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
                    $('#assignment-list-data').html(response.all_list);
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

        function generatePDF() {

            const template_id = $('#template').val();
            const day = $('[data-custom-chb]:checked').val();


            window.location.replace = "{{ route('admin.template.createPDF') }}";

            // $.ajax({
            //     type: "get",
            //     url: "{{ route('admin.template.createPDF') }}",
            //     data: {
            //         template_id: template_id,
            //         day: day,
            //     },
            //     success: function(response) {
            //         alert('response')
            //         console.log(response);
            //     }
            // });

        }

        function refreshData() {
            const template_id = $('#template').val();
            const day = $('[data-custom-chb]:checked').val();
            $('#create_pdf').attr('href', "{{ route('admin.template.createPDF') }}");
            fetchMealData(template_id, day);

        }

        function recipeAssignmentDeleted(data) {
            const template_id = $('#template').val();
            const day = $('[data-custom-chb]:checked').val();
            $('#create_pdf').attr('href', "{{ route('admin.template.createPDF') }}");

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

            const value = data.extra
            const delta = fullEditor_details.clipboard.convert(value)

            fullEditor_details.setContents(delta, 'silent')
            $('#edit-meal').modal('show');
        });


        function resetData(response) {
            // $('#guideline').text(response.data.guideline);
            fullEditor_guideline.root.innerHTML = response.data.guideline;
        }
    </script>

@endsection
