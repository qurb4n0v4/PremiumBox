<div class="featured-gift-sets-section">
    <h2 class="featured-gift-sets-title">
        Featured Premade Gift Sets
    </h2>
    <div class="gift-sets-slider-container">
        <div class="gift-sets-slider">
            @foreach($giftSets as $giftSet)
                <div class="gift-sets-slider-item">
                    <div class="gift-sets-image-wrapper">
                        <img src="{{ Storage::url($giftSet->normal_image) }}"
                             alt="{{ $giftSet->title }}"
                             title="{{ $giftSet->title }}"
                             class="gift-sets-image-default">
                        <img src="{{ Storage::url($giftSet->hover_image) }}"
                             alt="{{ $giftSet->title }}"
                             title="{{ $giftSet->title }}"
                             class="gift-sets-image-hover">
                    </div>
                    <p class="gift-sets-item-title">
                        {!! nl2br(e($giftSet->title)) !!}
                        @if($giftSet->description)
                            <br>
                            <strong>{{ $giftSet->description }}</strong>
                        @endif
                    </p>
                </div>
            @endforeach
        </div>

        <div class="gift-sets-slider-dots">
            @php
                $slidesPerView = 4; // Default for desktop
                $totalDots = ceil(count($giftSets) / $slidesPerView);
            @endphp

            @for($i = 0; $i < $totalDots; $i++)
                <span class="gift-sets-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></span>
            @endfor
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const slider = document.querySelector(".gift-sets-slider");
        const items = document.querySelectorAll(".gift-sets-slider-item");
        const dots = document.querySelectorAll(".gift-sets-dot");

        let currentSlide = 0;
        let autoplayInterval;

        function getSlidesPerView() {
            return window.innerWidth >= 1200 ? 4 :
                window.innerWidth >= 768 ? 2 : 1;
        }

        let slidesPerView = getSlidesPerView();

        function updateDots() {
            const totalDots = Math.ceil(items.length / slidesPerView);
            const dotsContainer = document.querySelector('.gift-sets-slider-dots');

            // Clear existing dots
            dotsContainer.innerHTML = '';

            // Create new dots based on current slidesPerView
            for (let i = 0; i < totalDots; i++) {
                const dot = document.createElement('span');
                dot.className = `gift-sets-dot ${i === Math.floor(currentSlide / slidesPerView) ? 'active' : ''}`;
                dot.dataset.index = i;
                dot.addEventListener('click', () => {
                    const targetSlide = i * slidesPerView;
                    goToSlide(targetSlide);
                });
                dotsContainer.appendChild(dot);
            }
        }

        function goToSlide(index) {
            const maxSlide = items.length - slidesPerView;

            if (index > maxSlide) {
                index = maxSlide;
            }
            if (index < 0) index = 0;

            currentSlide = index;

            const slidePercentage = (100 / slidesPerView);
            slider.style.transform = `translateX(-${slidePercentage * currentSlide}%)`;

            // Update dots
            const dots = document.querySelectorAll('.gift-sets-dot');
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === Math.floor(currentSlide / slidesPerView));
            });
        }

        function startAutoplay() {
            autoplayInterval = setInterval(() => {
                const nextSlide = currentSlide >= items.length - slidesPerView ? 0 : currentSlide + 1;
                goToSlide(nextSlide);
            }, 5000);
        }

        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        window.addEventListener('resize', () => {
            const newSlidesPerView = getSlidesPerView();
            if (newSlidesPerView !== slidesPerView) {
                slidesPerView = newSlidesPerView;
                updateDots();
                goToSlide(Math.floor(currentSlide / slidesPerView) * slidesPerView);
            }
        });

        slider.addEventListener('mouseenter', stopAutoplay);
        slider.addEventListener('mouseleave', startAutoplay);

        // Initialize
        updateDots();
        startAutoplay();
    });
</script>
