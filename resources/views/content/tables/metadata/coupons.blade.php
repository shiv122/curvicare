@extends('layouts/contentLayoutMaster')

@section('title', 'Add Coupon')

@section('page-style')
    <style>

    </style>
@endsection

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>
                    {!! $dataTable->table() !!}
                </x-card>
            </div>
        </div>
    </section>

    <x-side-modal title="Add coupon" id="add-coupon-modal">
        <x-form id="add-age-group" :reload="true" method="POST" class="" :route="route('admin.metadata.coupon.store')">
            <div class=" col-12 ">
                <x-input name="title" />
            </div>
            <div class="col-md-8 col-12 ">
                <x-input name="code" />
            </div>
            <div class=" col-md-4 col-12 text-center">
                <x-custom-switch :checked="true" id="key-switch" sync_to="#is_amount" label="Percent/Amount" />
                <x-input name="is_amount" value="on" type="hidden" />
            </div>
            <div data-parent class="col-md-8 col-12 d-none">
                <x-input name="percent" attrs='step="0.1" disabled data-percent' type="number" />
            </div>
            <div data-parent class=" col-md-8 col-12 ">
                <x-input name="amount" attrs='step="0.1" data-amount' type="number" />
            </div>
            <div class="col-md-4 col-12 text-center">
                <x-custom-switch :checked="true" id="currency-switch" label="Dollar/Rupees" sync_to="#is_rupees" />
                <x-input name="is_rupees" value="on" type="hidden" />
            </div>
        </x-form>
    </x-side-modal>


    <x-side-modal title="edit coupon" id="edit-coupon-modal">
        <x-form id="edit-age-group" :reload="true" method="POST" class="" :route="route('admin.metadata.coupon.update')">
            <div class=" col-12 ">
                <x-input name="title" />
                <x-input name="id" type="hidden" />

            </div>
            <div class="col-md-8 col-12 ">
                <x-input name="code" />
            </div>
            <div class=" col-md-4 col-12 text-center">
                <x-custom-switch :checked="true" id="edit-key-switch" sync_to="#edit_is_amount" label="Percent/Amount" />
                <x-input name="is_amount" id="edit_is_amount" value="on" type="hidden" />
            </div>
            <div data-parent class="col-md-8 col-12 d-none">
                <x-input name="percent" attrs='step="0.1" disabled data-percent' type="number" />
            </div>
            <div data-parent class=" col-md-8 col-12 ">
                <x-input name="amount" attrs='step="0.1" data-amount' type="number" />
            </div>
            <div class="col-md-4 col-12 text-center">
                <x-custom-switch :checked="true" id="edit-currency-switch" label="Dollar/Rupees"
                    sync_to="#edit_is_rupees" />
                <x-input name="is_rupees" id="edit_is_rupees" value="on" type="hidden" />
            </div>
        </x-form>
    </x-side-modal>


@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $('#coupon-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-coupon-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );
            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
            $('#key-switch,#edit-key-switch').change(function() {
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

            $('#currency-switch,#edit-currency-switch').change(function() {
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

        function setValue(data, modal) {

            $(`${modal} #id`).val(data.id);
            $(`${modal} #title`).val(data.title);
            $(`${modal} #code`).val(data.code);
            if (data.currency === 'INR') {
                $(`${modal} #edit-currency-switch`).prop('checked', true)
                $(`${modal} #edit_is_rupees`).val('on');
            } else {
                $(`${modal} #edit-currency-switch`).prop('checked', false);
                $(`${modal} #edit_is_rupees`).val('off');
            }

            if (data.discount_type === 'amount') {
                $(`${modal} #edit-key-switch`).prop('checked', true)
                $(`${modal} [data-amount]`).removeAttr('disabled').closest('[data-parent]').removeClass(
                    'd-none');
                $(`${modal} [data-percent]`).attr('disabled', true).closest('[data-parent]').addClass(
                    'd-none');
                $(`${modal} [data-amount]`).val(data.discount_value);
            } else {
                $(`${modal} #edit-key-switch`).prop('checked', false);
                $(`${modal} [data-percent]`).removeAttr('disabled').closest('[data-parent]').removeClass(
                    'd-none');
                $(`${modal} [data-amount]`).attr('disabled', true).closest('[data-parent]').addClass(
                    'd-none');
                $(`${modal} [data-percent]`).val(data.discount_value);

            }

            $(`${modal} #amount`).val(data.discount_value);
            $(modal).modal('show');


        }
    </script>
@endsection
