document.addEventListener('DOMContentLoaded', function () {
    const sliderContainer = document.querySelector('.slider-container');
    const row = sliderContainer.querySelector('.row');
    const prevBtn = sliderContainer.querySelector('.prev');
    const nextBtn = sliderContainer.querySelector('.next');

    const items = row.querySelectorAll('.col-6');
    const itemCount = items.length;
    const itemsPerView = 4;
    let currentPosition = 0;
    let isAnimating = false;

    updateSliderView();

    prevBtn.addEventListener('click', () => {
        if (!isAnimating && currentPosition > 0) {
            slideItems('prev');
        }
    });

    nextBtn.addEventListener('click', () => {
        if (!isAnimating && currentPosition + itemsPerView < itemCount) {
            slideItems('next');
        }
    });

    function slideItems(direction) {
        isAnimating = true;

        const start = currentPosition;
        if (direction === 'next') {
            currentPosition += itemsPerView;
        } else if (direction === 'prev') {
            currentPosition -= itemsPerView;
        }

        // Yeni elementləri animasiya ilə göstər
        updateSliderView(() => {
            isAnimating = false; // Animasiya tamamlandıqda aktivliyi yenilə
        });
    }

    function updateSliderView(callback) {
        // Bütün elementləri gizlət
        items.forEach((item, index) => {
            if (index >= currentPosition && index < currentPosition + itemsPerView) {
                item.style.display = 'block';
                item.style.opacity = '0'; // Şəffaflıq
                setTimeout(() => {
                    item.style.transition = 'opacity 0.5s';
                    item.style.opacity = '1';
                }, 50);
            } else {
                item.style.display = 'none';
            }
        });

        // Düymə vəziyyətlərini yenilə
        prevBtn.style.display = currentPosition === 0 ? 'none' : 'block';
        nextBtn.style.display = currentPosition + itemsPerView >= itemCount ? 'none' : 'block';

        if (callback) callback();
    }
});
document.addEventListener('DOMContentLoaded', () => {
    const cardItems = document.querySelectorAll('.card-item img');
    const selectedCardContainer = document.getElementById('selected-card-container');
    const sliderContainer = document.getElementById('slider-container');
    const selectedCardImage = document.getElementById('selected-card-image');
    const selectedCardName = document.getElementById('selected-card-name');
    const selectedCardPrice = document.getElementById('selected-card-price');
    const resetSlider = document.getElementById('reset-slider');

    // Kart seçmə və aktivləşdirmə
    cardItems.forEach(card => {
        card.addEventListener('click', function () {
            const cardId = this.closest('.card-item').dataset.id;
            const cardName = this.dataset.name;
            const cardPrice = this.dataset.price || "No Price";

            // Aktiv kartı göstər
            sliderContainer.style.display = 'none';
            selectedCardContainer.style.display = 'block';

            // Şəkil və məlumatları göstər
            selectedCardImage.src = this.src;
            selectedCardName.textContent = cardName;
            selectedCardPrice.textContent = cardPrice;

            // Aktiv sinifini əlavə et
            cardItems.forEach(img => img.classList.remove('active-card'));
            this.classList.add('active-card');
        });
    });

    // Yenidən seçim
    resetSlider.addEventListener('click', function () {
        sliderContainer.style.display = 'block';
        selectedCardContainer.style.display = 'none';

        // Aktiv sinifi təmizlə
        cardItems.forEach(img => img.classList.remove('active-card'));
    });
});
// JavaScript function to handle the variant change
function changeVariantActive(selectedIndex) {
    // Get all variant buttons
    let variantButtons = document.querySelectorAll('.variant-button');

    // Remove 'active' class from all buttons
    variantButtons.forEach(function(button) {
        button.classList.remove('active');
    });

    // Add 'active' class to the selected button
    variantButtons[selectedIndex].classList.add('active');
}

// Automatically activate the first variant when the page loads
document.addEventListener("DOMContentLoaded", function() {
    // Find the first button with the 'active' class and add it
    let firstButton = document.querySelector('.variant-button');
    if (firstButton) {
        firstButton.classList.add('active');
    }
});

function previewImage(event, id) {
    const input = event.target;
    const label = document.querySelector(`#image-preview-${id}`);
    const img = document.querySelector(`#image-preview-img-${id}`);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            img.src = e.target.result;
            img.style.display = 'block'; // Şəkili göstəririk
            label.style.display = 'none'; // `+` işarəsini gizlədirik
        };

        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const boxItems = document.querySelectorAll('.box-item');
    const prevButton = document.querySelector('.boxes-prev');
    const nextButton = document.querySelector('.boxes-next');

    const itemsPerSlide = 4;
    const totalItems = boxItems.length;
    let currentIndex = 0;

    // İlk yüklemede prev butonunu gizle
    if(prevButton) prevButton.style.display = totalItems <= 4 ? 'none' : 'none';
    if(nextButton) nextButton.style.display = totalItems <= 4 ? 'none' : 'flex';

    const showItems = (startIndex) => {
        // Tüm öğeleri gizle
        boxItems.forEach(item => {
            item.style.display = 'none';
        });

        // Sadece gösterilmesi gereken öğeleri göster
        for(let i = startIndex; i < Math.min(startIndex + itemsPerSlide, totalItems); i++) {
            boxItems[i].style.display = 'block';
        }

        // Butonların görünürlüğünü güncelle
        if(prevButton) prevButton.style.display = startIndex === 0 ? 'none' : 'flex';
        if(nextButton) nextButton.style.display = startIndex + itemsPerSlide >= totalItems ? 'none' : 'flex';
    };

    if(nextButton) {
        nextButton.addEventListener('click', () => {
            if(currentIndex + itemsPerSlide < totalItems) {
                currentIndex += itemsPerSlide;
                showItems(currentIndex);
            }
        });
    }

    if(prevButton) {
        prevButton.addEventListener('click', () => {
            if(currentIndex > 0) {
                currentIndex -= itemsPerSlide;
                showItems(currentIndex);
            }
        });
    }

    // İlk yükleme
    showItems(0);
});

document.addEventListener('DOMContentLoaded', function() {
    const giftBoxImages = document.querySelectorAll('.gift-box-img');

    giftBoxImages.forEach(img => {
        img.addEventListener('click', function() {
            giftBoxImages.forEach(image => {
                image.classList.remove('active');
            });

            this.classList.add('active');

            const boxId = this.getAttribute('data-box-id');
            console.log('Selected box ID:', boxId);
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const fontButtons = document.querySelectorAll('.font-button-customizing-edit');

    fontButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            fontButtons.forEach(btn => {
                btn.classList.remove('active');
            });

            // Add active class to clicked button
            this.classList.add('active');

            // Optional: You can get the selected font if needed
            const selectedFont = this.getAttribute('data-font');
            console.log('Selected font:', selectedFont);
        });
    });
});
