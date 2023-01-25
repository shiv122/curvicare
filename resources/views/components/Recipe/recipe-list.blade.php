@props([
    'assignments' => [],
])


@forelse ($assignments as $assignment)
    <div class="col-md-6 col-12 mb-2">
        <div class="recipe-holder">
            <div class="row m-0 w-100">
                <div class="col-md-4 p-0">
                    <div class="recipe-image">
                        <img src="{{ asset($assignment->recipe->image) }}" alt="{{ $assignment->recipe->name }}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="recipe-info">
                        <h5 class="recipe-name">
                            <a
                                href="{{ route('admin.recipe.show', $assignment->recipe->id) }}">{{ $assignment->recipe->name }}</a>
                        </h5>
                        <small>
                            @foreach ($assignment->recipe->compositions as $comp)
                                <span class="badge badge-pill badge-light-info">{{ $comp->name }}
                                    {{ $comp->quantity?->percentage }} %</span>
                                <br />
                            @endforeach
                        </small>

                        <div class="recipe-action">
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
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty

    <div class="col-12">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <div class="alert-body">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button>
                <span class="glyphicon glyphicon-ok"></span> <strong>Info Message</strong>
                <hr class="message-inner-separator">
                <p>
                    No recipes assigned yet to this template.</p>
            </div>
        </div>
    </div>

@endforelse