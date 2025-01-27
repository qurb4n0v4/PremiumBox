<section class="partners-section my-4">
    <h2 class="partners-title text-center mb-4">Tərəfdaşlarımız</h2>
    <div class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Swiper Slides -->
                @foreach($partners as $partner)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $partner->logo) }}"
                             class="partner-logo img-fluid"
                             alt="Tərəfdaş Loqosu {{ $partner->name }}" loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
