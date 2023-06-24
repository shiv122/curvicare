@extends('layouts/contentLayoutMaster')

@section('title', 'Update Recipe')

@section('page-style')
    <style>
        .ce-block__content,
        .ce-toolbar__content {

            max-width: 90% !important;
        }
    </style>
@endsection
@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Update Recipe">
                    <form id="update-recipe-form" novalidate>
                        <div class="row">
                            <div class="col-md-6 col-12 ">
                                <x-input :value="$recipe->name" name="name" />
                                <input type="hidden" name="id" hidden value="{{ $recipe->id }}">
                            </div>
                            <div class="col-md-6 col-12 ">
                                <x-input-file name="image" />
                            </div>
                            <div class="col-md-12 col-12 ">
                                <x-select name="tags" :multiple="true" :options="$tags" />
                            </div>
                            <div class="col-md-12 col-12 ">
                                <x-select name="is_paid" :options="['yes', 'no']" />
                            </div>
                            <div class="col-md-12 col-12 ">
                                <x-divider text="Recipe Body" />
                                <div id="editor">

                                </div>
                                <input type="hidden" name="recipe" id="recipe_body">
                                {{-- <x-editor name="body" label="Recipe Body" /> --}}
                            </div>
                            <div class="col-md-12 col-12 mt-2">
                                <x-input :value="$recipe->caution" name="caution" type="textarea" />
                            </div>

                            <div class="col-12 mt-4">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </section>


@endsection
@section('page-script')
    <script src="{{ asset(mix('js/editor.js')) }}"></script>
    <script>
        const tags = @json($recipe->tags->pluck('id'));
        $(document).ready(async function() {
            $('#tags').val(tags).trigger('change');
            $('#is_paid').val('{{ $recipe->is_paid }}').trigger('change');
            const data = @json(json_decode($recipe->recipe));
            console.log(data);
            console.log(window.editor);
            await renderEditorData(data);
        });

        async function renderEditorData(data) {
            window.editor.isReady.then(() => {
                window.editor.render(data);
            });

        }


        $('#update-recipe-form').submit(async function(e) {
            e.preventDefault();
            const route = "{{ route('admin.recipe.update') }}";
            const editor_data = await getEditorData();
            $('#recipe_body').val(editor_data);
            reboundForm({
                selector: $(this),
                route: route
            });



        });

        async function getEditorData() {
            const outputData = await window.editor.save();
            const jsonData = JSON.stringify(outputData);
            return jsonData;
        }
    </script>
@endsection
