@extends('layouts/contentLayoutMaster')

@section('title', 'Add Recipe')

@section('page-style')
@endsection
@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Add Recipe">
                    <x-slot name="card_body">
                        <x-form id="add-recipe-form" :reset="0" method="POST" class="" :route="route('admin.recipe.store')">
                            <x-slot name="form">
                                <div class="col-md-6 col-12 ">
                                    <x-input name="name" />
                                </div>
                                <div class="col-md-6 col-12 ">
                                    <x-input-file name="image" />
                                </div>
                                <div class="col-md-12 col-12 ">
                                    <x-select name="foods" :multiple="true" :options="$foods" />
                                </div>
                                <div class="col-md-12 col-12 ">
                                    <x-select name="tags" :multiple="true" :options="$tags" />
                                </div>
                                <div class="col-md-12 col-12 ">
                                    <x-input name="caution" type="textarea" />
                                </div>
                                <x-divider class="custom-divider" text="Add composition" />
                                <x-repeater name="composition" :fields="[
                                    [
                                        'name' => 'nutrients',
                                        'type' => 'select',
                                        'options' => $nutrients,
                                        'col' => 6,
                                    ],
                                    ['name' => 'percent', 'type' => 'number', 'col' => 4],
                                ]" />
                            </x-slot>
                        </x-form>
                    </x-slot>
                </x-card>
            </div>
        </div>
    </section>


@endsection
@section('page-script')

@endsection
