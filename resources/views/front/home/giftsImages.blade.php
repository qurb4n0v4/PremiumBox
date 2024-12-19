<div class="featured-gift-sets-section">
    <h2 class="featured-gift-sets-title">
        Featured Premade Gift Sets
    </h2>
    <div class="gift-sets-slider-container">
        <div class="gift-sets-slider">
            <div class="gift-sets-slider-item">
                <div class="gift-sets-image-wrapper">
                    <img src="{{ asset('assets/front/img/red.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-default">
                    <img src="{{ asset('assets/front/img/violet.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-hover">
                </div>
                <p class="gift-sets-item-title">
                    BOX & TALE CHRISTMAS 2024 X SABABAY WINERY <br>
                    <strong>Whimsical Mistelle</strong>
                </p>
            </div>

            <div class="gift-sets-slider-item">
                <div class="gift-sets-image-wrapper">
                    <img src="{{ asset('assets/front/img/yellow.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-default">
                    <img src="{{ asset('assets/front/img/violet.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-hover">
                </div>
                <p class="gift-sets-item-title">
                    BOX & TALE CHRISTMAS 2024 X SABABAY WINERY <br>
                    <strong>Whimsical Mistelle</strong>
                </p>
            </div>

            <div class="gift-sets-slider-item">
                <div class="gift-sets-image-wrapper">
                    <img src="{{ asset('assets/front/img/red.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-default">
                    <img src="{{ asset('assets/front/img/violet.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-hover">
                </div>
                <p class="gift-sets-item-title">
                    BOX & TALE CHRISTMAS 2024 X SABABAY WINERY <br>
                    <strong>Whimsical Mistelle</strong>
                </p>
            </div>

            <div class="gift-sets-slider-item">
                <div class="gift-sets-image-wrapper">
                    <img src="{{ asset('assets/front/img/red.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-default">
                    <img src="{{ asset('assets/front/img/violet.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-hover">
                </div>
                <p class="gift-sets-item-title">
                    BOX & TALE CHRISTMAS 2024 X SABABAY WINERY <br>
                    <strong>Whimsical Mistelle</strong>
                </p>
            </div>

            <div class="gift-sets-slider-item">
                <div class="gift-sets-image-wrapper">
                    <img src="{{ asset('assets/front/img/red.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-default">
                    <img src="{{ asset('assets/front/img/violet.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-hover">
                </div>
                <p class="gift-sets-item-title">
                    BOX & TALE CHRISTMAS 2024 X SABABAY WINERY <br>
                    <strong>Whimsical Mistelle</strong>
                </p>
            </div>
            <div class="gift-sets-slider-item">
                <div class="gift-sets-image-wrapper">
                    <img src="{{ asset('assets/front/img/red.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-default">
                    <img src="{{ asset('assets/front/img/violet.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-hover">
                </div>
                <p class="gift-sets-item-title">
                    BOX & TALE CHRISTMAS 2024 X SABABAY WINERY <br>
                    <strong>Whimsical Mistelle</strong>
                </p>
            </div>

            <div class="gift-sets-slider-item">
                <div class="gift-sets-image-wrapper">
                    <img src="{{ asset('assets/front/img/red.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-default">
                    <img src="{{ asset('assets/front/img/violet.webp') }}" alt="GiftBox"
                         title="GiftBox" class="gift-sets-image-hover">
                </div>
                <p class="gift-sets-item-title">
                    BOX & TALE CHRISTMAS 2024 X SABABAY WINERY <br>
                    <strong>Whimsical Mistelle</strong>
                </p>
            </div>

        </div>

        <div class="gift-sets-slider-dots">
            <span class="gift-sets-dot active" data-index="0"></span>
            <span class="gift-sets-dot" data-index="1"></span>
            <span class="gift-sets-dot" data-index="2"></span>
        </div>
    </div>
</div>
<style>
    /* General Section Styles */
    .featured-gift-sets-section {
        text-align: center;
        margin: 40px 0;
    }

    .featured-gift-sets-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    /* Slider Styles */
    .gift-sets-slider-container {
        position: relative;
        overflow: hidden;
        max-width: 1200px;
        margin: 0 auto;
    }

    .gift-sets-slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .gift-sets-slider-item {
        min-width: 100%;
        box-sizing: border-box;
        padding: 15px;
    }

    /* Image Wrapper and Hover Effect */
    .gift-sets-image-wrapper {

        position: relative;
        z-index: 10;
        width: 300px;
        height: 300px;
        overflow: hidden;
    }

    .gift-sets-image-default,
    .gift-sets-image-hover {
        width: 100%;
        height: auto;
        transition: opacity 0.3s ease;
        position: absolute;
        top: 0;
        left: 0;
        object-fit: cover;
        display: block;
        opacity: 1;
        visibility: visible !important;
    }

    .gift-sets-image-hover {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }

    .gift-sets-image-wrapper:hover .gift-sets-image-hover {
        opacity: 1;
    }

    /* Item Title */
    .gift-sets-item-title {
        margin-top: 15px;
        font-size: 16px;
        color: #555;
        line-height: 1.4;
    }

    /* Dots Navigation */
    .gift-sets-slider-dots {
        margin-top: 15px;
    }

    .gift-sets-dot {
        height: 10px;
        width: 10px;
        margin: 0 5px;
        background-color: #ddd;
        border-radius: 50%;
        display: inline-block;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .gift-sets-dot.active,
    .gift-sets-dot:hover {
        background-color: #555;
    }

    /* Responsive Design */
    @media (min-width: 768px) {
        .gift-sets-slider-item {
            min-width: 50%;
        }
    }

    @media (min-width: 1200px) {
        .gift-sets-slider-item {
            min-width: 25%;
        }
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".gift-sets-slider");
    const dots = document.querySelectorAll(".gift-sets-dot");
    let currentIndex = 0;

    function updateSlider(index) {
    const translateX = -index * 100;
    slider.style.transform = `translateX(${translateX}%)`;
    dots.forEach(dot => dot.classList.remove("active"));
    dots[index].classList.add("active");
    }

    dots.forEach((dot, index) => {
    dot.addEventListener("click", () => {
    currentIndex = index;
    updateSlider(currentIndex);
    });
    });

    // Auto-slide every 5 seconds
    setInterval(() => {
    currentIndex = (currentIndex + 1) % dots.length;
    updateSlider(currentIndex);
    }, 5000);
    });
</script>
