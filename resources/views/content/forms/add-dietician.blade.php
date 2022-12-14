@extends('layouts/contentLayoutMaster')

@section('title', 'Add Dietician')

@section('page-style')
    <style>
        #map {
            width: 100%;
            height: 400px;
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
                <x-card title="Add Dietician">
                    <x-form id="add-age-group" method="POST" class="" :route="route('admin.dietician.store')">
                        <div class="col-md-6 col-12 ">
                            <x-input name="name" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input type="email" name="email" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input type="phone" name="phone" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input type="text" name="location" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-select :options="$genders" name="gender" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input-file name="image" />
                        </div>
                        <div class="col-md-12 col-12 ">
                            <x-input name="address" type="textarea" />
                        </div>
                        <div class="col-md-6 col-8 ">
                            <x-input name="username" />
                        </div>
                        <div class="col-md-2 col-2 d-flex align-items-center justify-content-center">
                            <x-button id="generate-username" text="Generate Username" />
                        </div>
                        <div class="col-md-4 col-12 ">
                            <x-input name="password" :required="false" />
                        </div>
                        <x-divider class="custom-divider" text="Bank details" />
                        <div class="col-md-6 col-12 ">
                            <x-input name="bank_name" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input name="account_number" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input name="ifsc_code" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input name="branch_name" />
                        </div>
                        <x-divider class="custom-divider" text="Kyc Details" />
                        <div class="col-md-2 col-12 ">
                            <x-custom-switch :checked="true" name="kyc_switch" id="key-switch" label="Pan/Aadhar" />
                        </div>
                        <div data-aadhar class="col-md-4 col-12 ">
                            <x-input name="aadhar_card_number" />
                        </div>
                        <div data-aadhar class="col-md-6 col-12 ">
                            <x-input-file name="aadhar_card_image" />
                        </div>
                        <div data-pan class="col-md-4 col-12 d-none ">
                            <x-input attrs='disabled="true"' name="pan_card_number" />
                        </div>
                        <div data-pan class="col-md-6 col-12 d-none ">
                            <x-input-file attrs='disabled="true"' name="pan_card_image" />
                        </div>
                        <div class="col-md-12 col-12 ">
                            <x-input-file name="certificate" />
                        </div>
                        <x-divider class="custom-divider" text="Misc" />
                        <div class="col-md-6 col-12 ">
                            <x-select name="expertise" :multiple="true" :options="$expertise" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-select name="for" :options="['local', 'abroad', 'global']" />
                        </div>
                    </x-form>
                </x-card>
            </div>
        </div>
    </section>
    <x-map linked_to="#location" :modal="true" />

@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $('#generate-username').on('click', function() {
                const name = $('#name').val();
                if (name.length == 0) {
                    snb('error', 'Empty', 'Please enter name');
                    return;
                }
                const name1 = (name.split(' ')[0]).substring(0, 3);
                const name2 = (name.split(' ')[1]) ? (name.split(' ')[1]).substring(0, 3) : '';
                const surname = name1 + name2 + Math.floor(Math.random() * (999 - 100) + 10);
                $('#username').val(surname);
            });

            $('#key-switch').on('change', function() {
                if ($(this).is(':checked')) {
                    $('[data-aadhar]').removeClass('d-none');
                    $('[data-aadhar]').find(':input').attr('disabled', false);
                    $('[data-pan]').find(':input').attr('disabled', true);
                    $('[data-pan]').addClass('d-none');
                } else {
                    $('[data-aadhar]').addClass('d-none');
                    $('[data-aadhar]').find(':input').attr('disabled', true);
                    $('[data-pan]').find(':input').attr('disabled', false);
                    $('[data-pan]').removeClass('d-none');
                }
            });
        });
    </script>
@endsection
