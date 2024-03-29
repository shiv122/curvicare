@extends('layouts/contentLayoutMaster')

@section('title', 'Add Recipe')

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
                <x-card title="Add Recipe">
                    <form id="add-recipe-form" novalidate>
                        <div class="row">
                            <div class="col-md-6 col-12 ">
                                <x-input name="name" />
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
                                <x-input name="caution" type="textarea" />
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
        $('#add-recipe-form').submit(async function(e) {
            e.preventDefault();
            const route = "{{ route('admin.recipe.store') }}";
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
