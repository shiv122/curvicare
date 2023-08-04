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
                    <form class="row">
                        <div class="col-md-6 col-12 ">
                            <x-input :value="$dietician->name" name="name" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input type="email" :value="$dietician->email" name="email" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input type="phone" :value="$dietician->phone" name="phone" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input type="text" :value="$dietician->location" name="location" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-select :options="$genders" name="gender" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input name="username" :value="$dietician->username" />
                        </div>
                        <div class="col-md-12 col-12 ">
                            <x-input name="address" :value="$dietician->address" type="textarea" />
                        </div>



                        <x-divider class="custom-divider" text="Bank details" />
                        <div class="col-md-6 col-12 ">
                            <x-input :value="$bank->bank_name" name="bank_name" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input :value="$bank->account_number" name="account_number" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input :value="$bank->ifsc_code" name="ifsc_code" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input :value="$bank->branch_name" name="branch_name" />
                        </div>

                    </form>
                </x-card>
            </div>
        </div>
    </section>
    <x-map linked_to="#location" :modal="true" />

@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $('#gender').val('{{ $dietician->gender }}').trigger('change');
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
