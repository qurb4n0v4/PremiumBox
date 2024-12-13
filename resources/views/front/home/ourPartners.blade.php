{{--<div class="partners-section">--}}
{{--    <h2 class="partners-title">Əməkdaşlıqlarımız</h2>--}}
{{--    <div class="partners-slider swiper-container">--}}
{{--        <div class="partners-list swiper-wrapper">--}}
{{--            @foreach($partners as $partner)--}}
{{--                <div class="partner-item swiper-slide">--}}
{{--                    <img src="{{ $partner -> logo }}" alt="{{ $partner -> name }}" class="partner-logo">--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div class="slider-next swiper-button-next"></div>--}}
{{--        <div class="slider-prev swiper-button-prev"></div>--}}
{{--        <div class="slider-pagination swiper-pagination"></div>--}}
{{--    </div>--}}
{{--</div>--}}
{{----}}
<section class="partners-section my-2">
    <h2 class="partners-title text-center mb-4">Our Partners</h2>
    <div class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Swiper Slides -->
                @for($i = 0; $i < 20; $i++)
                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/lacoste.png') }}"
                         class="partner-logo img-fluid"
                         alt="Partner Logo {{ $i + 1 }}" loading="lazy">
                </div>
                @endfor
            </div>

        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>


