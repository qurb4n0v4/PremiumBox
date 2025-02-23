// Images slider
document.addEventListener('DOMContentLoaded', function () {
    new bootstrap.Carousel(document.querySelector('#carouselGiftSlides'), {
        interval: 2000,
        wrap: true,
    });
});

// Partners slider
document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 5,
        slidesPerGroup: 1,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            1024: {
                slidesPerView: 4,
            },
            768: {
                slidesPerView: 3,
            },
            480: {
                slidesPerView: 2,
            },
            0: {
                slidesPerView: 2,
            }
        }
    });
});




// FAQ
document.querySelectorAll('.question').forEach(question => {
    question.addEventListener('click', () => {
        const faqItem = question.closest('.faq-item');
        const animatedLine = faqItem.querySelector('.animated-line');
        const wasActive = faqItem.classList.contains('active');

        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.remove('active');
            item.querySelector('.animated-line').classList.remove('active');
        });

        if (!wasActive) {
            faqItem.classList.add('active');
            animatedLine.classList.add('active');
        }
    });
});
