// images slider started
document.addEventListener('DOMContentLoaded', function () {
    new bootstrap.Carousel(document.querySelector('#carouselGiftSlides'), {
        interval: 2000,
        wrap: true,
    });
});

// partners slider
document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 5,
        slidesPerGroup: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});
