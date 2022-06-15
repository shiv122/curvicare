@extends('layouts/contentLayoutMaster')

@section('title', 'Add Food')

@section('page-style')
@endsection

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Add Food">
                    <x-slot name="card_body">
                        <x-form id="add-food" method="POST" class="" :route="route('admin.food.store')">
                            <x-slot name="form">
                                <div class="col-md-6 col-12 ">
                                    <x-input name="name" />
                                </div>
                                <div class="col-md-6 col-12 ">
                                    <x-input-file attrs='required accept="image/*"' :multiple="true" name="images" />
                                </div>
                                <x-divider class="custom-divider" text="Add ingredients" />
                                <x-repeater name="ingredients" :fields="[
                                    [
                                        'name' => 'ingredient_name',
                                        'type' => 'select',
                                        'options' => $ingredients,
                                        'col' => 4,
                                    ],
                                    ['name' => 'quantity', 'type' => 'number', 'col' => 3],
                                    ['name' => 'unit', 'col' => 3],
                                ]" />
                                <div class="col-md-12 col-12 ">
                                    <x-editor name="description" label="Description" />
                                </div>

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
