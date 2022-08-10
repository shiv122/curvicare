@extends('layouts/contentLayoutMaster')

@section('title', 'Pricing')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base/pages/page-pricing.css') }}">
@endsection

@section('content')
    <section id="pricing-plan">
        <div class="text-center">
            <h1 class="mt-5">Pricing Plans</h1>
            <div class="d-flex align-items-center justify-content-center mb-5 pb-50">
                <h6 class="mr-1 mb-0">DOLLAR</h6>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="priceSwitch" />
                    <label class="custom-control-label" for="priceSwitch"></label>
                </div>
                <h6 class="ml-50 mb-0">INR</h6>
            </div>
        </div>

        <!-- pricing plan cards -->
        <div class="row pricing-card">
            <div class="col-12 col-sm-offset-2 col-sm-10 col-md-12 col-lg-offset-2 col-lg-10 mx-auto">
                <div class="row d-flex justify-content-center">


                    <!-- standard plan -->
                    <div class="col-12 col-md-6">
                        <div class="card standard-pricing popular text-center">
                            <div class="card-body">
                                {{-- <div class="pricing-badge text-right">
                                    <div class="badge badge-pill badge-light-primary">Popular</div>
                                </div> --}}
                                <img src="{{ asset($package->image) }}" height="75" width="75" class="mb-1"
                                    alt="svg img" />
                                <h3>{{ $package->title }}</h3>
                                <div class="annual-plan">
                                    @forelse ($package->prices as $price)
                                        <div
                                            class="price__parent class__{{ $price->currency }}
                                            @if (!$loop->first) d-none @endif
                                        ">
                                            <div class="plan-price mt-2">
                                                <sup class="font-medium-1 font-weight-bold text-primary">
                                                    @if ($price->currency == 'USD')
                                                        $
                                                    @else
                                                        ₹
                                                    @endif
                                                </sup>
                                                <span
                                                    class="pricing-standard-value font-weight-bolder text-primary">{{ $price->price }}</span>
                                                <sub class="pricing-duration text-body font-medium-1 font-weight-bold">/{{ $package->duration }}
                                                    days</sub>
                                            </div>
                                            <small class="annual-pricing d-none text-muted"></small>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                                <ul class="list-group list-group-circle text-left">
                                    @forelse ($package->features as $feat)
                                        <li class="list-group-item">{{ $feat->title }}</li>
                                    @empty
                                    @endforelse

                                </ul>
                                <button class="btn btn-block btn-primary mt-2">Buy</button>
                            </div>
                        </div>
                    </div>

                    <!--/ standard plan -->


                </div>
            </div>
        </div>
        <!--/ pricing plan cards -->



    </section>
@endsection

@section('page-script')
    <script>
        $(document).on('change', '#priceSwitch', function() {
            if (!$(this).is(':checked')) {
                $('.class__INR').addClass('d-none');
                $('.class__USD').removeClass('d-none');
            } else {
                $('.class__INR').removeClass('d-none');
                $('.class__USD').addClass('d-none');
            }
        });
    </script>
@endsection
