@extends('layouts/contentLayoutMaster')

@section('title', 'Add Coupon')

@section('page-style')
@endsection

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="Add Coupon">
                    <x-slot name="card_body">
                        <x-form id="add-age-group" :reload="true" method="POST" class="" :route="route('admin.metadata.coupon.store')">
                            <x-slot name="form">
                                <div class="col-md-6 col-12 ">
                                    <x-input name="title" />
                                </div>
                                <div class="col-md-6 col-12 ">
                                    <x-input name="code" />
                                </div>
                                <div class="col-md-2 col-12 ">
                                    <x-custom-switch :checked="true" id="key-switch" sync_to="#is_amount"
                                        label="Percent/Amount" />
                                    <x-input name="is_amount" value="on" type="hidden" />
                                </div>
                                <div data-parent class="col-md-8 col-12 d-none">
                                    <x-input name="percent" attrs='step="0.1" disabled data-percent' type="number" />
                                </div>
                                <div data-parent class="col-md-8 col-12 ">
                                    <x-input name="amount" attrs='step="0.1" data-amount' type="number" />
                                </div>
                                <div class="col-md-2 col-12 text-center">
                                    <x-custom-switch :checked="true" id="currency-switch" label="Dollar/Rupees"
                                        sync_to="#is_rupees" />
                                    <x-input name="is_rupees" value="on" type="hidden" />
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
    <script>
        $(document).ready(function() {
            $('#key-switch').change(function() {
                if ($(this).is(':checked')) {
                    $('[data-percent]').attr('disabled', true).closest('[data-parent]').addClass('d-none');
                    $('[data-amount]').removeAttr('disabled').closest('[data-parent]').removeClass(
                        'd-none');
                } else {
                    $('[data-amount]').attr('disabled', true).closest('[data-parent]').addClass('d-none');
                    $('[data-percent]').removeAttr('disabled').closest('[data-parent]').removeClass(
                        'd-none');
                }
            });

            $('#currency-switch').change(function() {
                if ($(this).is(':checked')) {
                    $("[data-parent] label").each(function(index) {
                        const text = $(this).text().split(' ')[0];
                        $(this).html(text + '<span class="text-danger"> (Rupees)</span>');
                    });
                } else {
                    $("[data-parent] label").each(function(index) {
                        const text = $(this).text().split(' ')[0];
                        $(this).html(text + '<span class="text-danger"> (Dollar)</span>');
                    });
                }
            });
        });
    </script>
@endsection
