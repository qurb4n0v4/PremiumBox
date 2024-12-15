<section class="partners-section my-2">
    <h2 class="partners-title text-center mb-4">Our Partners</h2>
    <div class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Swiper Slides -->
                @foreach($partners as $partner)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $partner->logo) }}"
                             class="partner-logo img-fluid"
                             alt="Partner Logo {{ $partner->name }}" loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
