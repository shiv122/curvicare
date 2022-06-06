@extends('layouts/contentLayoutMaster')

@section('title', 'Add User')

@section('page-style')

    <style>
        #table-card {
            padding: 10px;
        }
    </style>
@endsection

@section('content')
    @php
    $genders = json_decode(json_encode([['id' => 'male', 'name' => 'Male'], ['id' => 'female', 'name' => 'Female'], ['id' => 'other', 'name' => 'Other']]));
    @endphp
    <!-- Dashboard Analytics Start -->
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Add User">
                    <x-slot name="card_body">
                        <x-form id="add-age-group" method="POST" class="" :route="route('admin.user.store')">
                            <x-slot name="form">
                                <div class="col-md-6 col-12 ">
                                    <x-input name="name" />
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
