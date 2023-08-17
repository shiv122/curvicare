<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<style>
    .recipe-holder {
        display: flex;
        gap: 1rem;
        /* border: 1px solid #c0bfc5; */
        border-radius: 5px;
        overflow: hidden;
        position: relative;
        padding: 1.5rem 1rem 0rem;
        /* box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset; */
    }

    .text-left {
        text-align: left !important;
        font-weight: bold;
    }

    .align-content-center {
        align-content: center;
    }

    .image {
        text-align: center;
        margin-bottom: 20px;

    }
</style>

<body>

    <div class="col-12 image">
        <img src="https://static.wixstatic.com/media/908385_c21ee7ba95b4406cb707029ae9e7bfb8~mv2.png/v1/fill/w_349,h_86,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/CurviCareSecondary%20Logo_CMYK_PNG_edited.png"
            alt="" />
    </div>
    <div class="col-12 text-left text-bold">


        @php
            $arr = ['early_morning', 'breakfast', 'mid_morning', 'pre_lunch', 'lunch', 'post_lunch', 'evening_snack', 'pre_dinner', 'dinner', 'post_dinner', 'pre_workout', 'post_workout'];
            
            foreach ($arr as $key => $value) {
                ${$value} = $helper->getAssignmentsByMeal($assignments, $value);
            }
        @endphp

        @foreach ($arr as $key => $value)
            @php $assignments = ${$value} @endphp
            @forelse ($assignments as $assignment)
                <h4>{{ ucfirst(str_replace('_', ' ', $value)) }}</h4>
                <div class="col-md-12 col-12 mb-2">
                    <div class="recipe-holder">
                        <div class="row m-0 w-100">
                            <div class="col-12">
                                {!! $assignment->extra !!}
                            </div>
                            <div class="col-12">
                                <div class="recipe-action">
                                    {{-- <button data-edit-meal="{{ json_encode($assignment->only('id', 'extra')) }}"
                                        class="btn btn-icon btn-sm btn-icon rounded-circle btn-info waves-effect waves-float waves-light">
                                        <svg style="height: 15px;width:15px;min-width:15px;" aria-hidden="true"
                                            focusable="false" data-prefix="fa-light" data-icon="pen-nib"
                                            class="svg-inline--fa fa-pen-nib fa-w-16" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path
                                                d="M496 73.72l-58.23-58.3C427.5 5.12 413.3 0 399.2 0c-14.15 0-28.26 5.118-38.42 15.29L283.8 88.51L138 134.4C115.8 140.7 98.11 157.6 90.63 179.1L.2983 501.8c-.7812 2.801 0 5.786 2.047 7.837C3.861 511.2 5.908 512 8.001 512c.7187 0 1.453-.0939 2.172-.297l321.8-90.55c22.02-7.383 38.92-25.14 45.16-47.24l45.86-146l72.1-76.9C506.3 140.7 512 126.1 512 112.4C512 97.75 506.3 84.03 496 73.72zM346.4 365.2c-3.385 12.01-12.56 21.57-23.02 25.12l-249.2 70.11l101.5-101.5C185.2 364.6 196.2 368 208 368c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64c0 11.83 3.447 22.79 9.066 32.31l-101.6 101.6l69.51-247.8C125.1 177.9 134.7 168.6 147.7 164.9l141.9-44.67l101.7 101.7L346.4 365.2zM176 304c0-17.64 14.36-32 32-32s32 14.36 32 32s-14.36 32-32 32S176 321.6 176 304zM472.8 128.1L409.9 195.3l-93.55-93.55l67.05-63.81C387.1 34.15 392.9 32 399.2 32c6.326 0 12.15 2.201 15.99 6.041l58.23 58.3C477.7 100.7 480 106.2 480 112.4C480 118.5 477.7 124.1 472.8 128.1z"
                                                fill="currentColor" />
                                        </svg>
                                    </button>
                                    <button type="button"
                                        data-delete="{{ route('admin.template.delete-assign-recipe', $assignment->id) }}"
                                        data-success-callback="recipeAssignmentDeleted"
                                        class="btn btn-icon btn-sm btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">
                                        <svg style="height: 15px;width:15px;min-width:15px;" aria-hidden="true"
                                            focusable="false" data-prefix="fa-regular" data-icon="trash-can"
                                            class="svg-inline--fa fa-trash-can fa-w-14" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path
                                                d="M432 80h-82.38l-34-56.75C306.1 8.827 291.4 0 274.6 0H173.4C156.6 0 141 8.827 132.4 23.25L98.38 80H16C7.125 80 0 87.13 0 96v16C0 120.9 7.125 128 16 128H32v320c0 35.35 28.65 64 64 64h256c35.35 0 64-28.65 64-64V128h16C440.9 128 448 120.9 448 112V96C448 87.13 440.9 80 432 80zM171.9 50.88C172.9 49.13 174.9 48 177 48h94c2.125 0 4.125 1.125 5.125 2.875L293.6 80H154.4L171.9 50.88zM352 464H96c-8.837 0-16-7.163-16-16V128h288v320C368 456.8 360.8 464 352 464zM224 416c8.844 0 16-7.156 16-16V192c0-8.844-7.156-16-16-16S208 183.2 208 192v208C208 408.8 215.2 416 224 416zM144 416C152.8 416 160 408.8 160 400V192c0-8.844-7.156-16-16-16S128 183.2 128 192v208C128 408.8 135.2 416 144 416zM304 416c8.844 0 16-7.156 16-16V192c0-8.844-7.156-16-16-16S288 183.2 288 192v208C288 408.8 295.2 416 304 416z"
                                                fill="#FFF" />
                                        </svg>
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $('[data-for="{{ $assignment->for }}"]').remove();
                </script>
            @empty
            @endforelse
        @endforeach


    </div>

</body>

</html>
