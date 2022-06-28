<div id="swpr{{ $id }}" class="swiper-default swiper-container {{ $class }}">
    <div class="swiper-wrapper">
        @foreach ($images as $i)
            <div class="swiper-slide">
                <img class="img-fluid" src="{{ asset($i) }}" alt="banner" />
            </div>
        @endforeach
    </div>
    @if ($pagination)
        <div class="swiper-pagination"></div>
    @endif

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

@pushonce('component-vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
@endpushonce

@pushonce('component-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-swiper.css')) }}">
@endpushonce

@pushonce('component-vendor-script')
    <script src="{{ asset(mix('vendors/js/extensions/swiper.min.js')) }}"></script>
@endpushonce

@push('component-script')
    <script>
        // var mySwipe_{{ $id }} = new Swiper('#swpr{{ $id }}', {
        //     navigation: {
        //         nextEl: '.swiper-button-next',
        //         prevEl: '.swiper-button-prev'
        //     }
        // });

        var mySwiper_{{ $id }} = new Swiper('#swpr{{ $id }}', {
            slidesPerView: 1,
            // spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            observer: true,
            observeParents: true,
        });
    </script>
@endpush
