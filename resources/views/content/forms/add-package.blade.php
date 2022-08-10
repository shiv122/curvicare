@extends('layouts/contentLayoutMaster')

@section('title', 'Add Package')

@section('page-style')
@endsection

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Add Package">
                    <x-form id="add-age-group" :reset="1" method="POST" class="" :route="route('admin.package.store')">
                        <div class="col-md-6 col-12 ">
                            <x-input name="title" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input-file attrs="required" name="image" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input name="price_in_rupees" attrs='step="0.1"' type="number" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input name="price_in_dollar" attrs='step="0.1"' type="number" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-input name="duration" type="number" label="Duration (days)"
                                placeholder="Enter duration in days" />
                        </div>
                        <div class="col-md-6 col-12 ">
                            <x-select name="coupon" :multiple="true" :options="$coupons" :required="false"
                                :additionalOptionText="['Currency type -', 'currency']" />
                        </div>
                        <div class="col-md-12 col-12 ">
                            <x-input type="textarea" name="terms_and_conditions" />
                        </div>
                        <x-divider class="custom-divider" text="Features" />
                        <x-repeater name="features" :fields="[['name' => 'features', 'col' => 10]]" />

                    </x-form>
                </x-card>
            </div>
        </div>
    </section>


@endsection
@section('page-script')

@endsection
