@extends('layouts/contentLayoutMaster')

@section('title', 'Add product')

@section('page-style')
@endsection

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Add product">
                    <x-slot name="card_body">
                        <x-form id="add-age-group" :reset="1" method="POST" class="" :route="route('admin.product.store')">
                            <x-slot name="form">
                                <div class="col-md-6 col-12 ">
                                    <x-input name="name" />
                                </div>
                                <div class="col-md-6 col-12 ">
                                    <x-input-file name="images" :multiple="true" />
                                </div>
                                <div class="col-md-12 col-12 ">
                                    <x-input name="link" type="url" />
                                </div>
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
