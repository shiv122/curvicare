@extends('layouts/contentLayoutMaster')

@section('title', 'Add blog')

@section('page-style')
@endsection

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Add Blog">
                    <x-slot name="card_body">
                        <x-form id="add-age-group" method="POST" class="" :route="route('admin.blog.store')">
                            <x-slot name="form">
                                <div class="col-md-12 col-12 ">
                                    <x-input name="title" />
                                </div>
                                <div class="col-md-12 col-12 ">
                                    <x-input-file name="images" :multiple="true" />
                                </div>
                                <div class="col-md-12 col-12 ">
                                    <x-select name="tags" :options="$tags" :multiple="true" />
                                </div>
                                <div class="col-md-12 col-12 ">
                                    <x-select name="dietician" :options="$dieticians" label="Blow Written by" />
                                </div>
                                <div class="col-md-12 col-12 ">
                                    <x-editor name="description" label="Blog Body" />
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
