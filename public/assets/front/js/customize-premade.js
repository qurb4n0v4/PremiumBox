document.addEventListener('DOMContentLoaded', function () {
    const sliderContainer = document.querySelector('.slider-container');
    const row = sliderContainer.querySelector('.row');
    const prevBtn = sliderContainer.querySelector('.prev');
    const nextBtn = sliderContainer.querySelector('.next');

    const items = row.querySelectorAll('.col-6');
    const itemCount = items.length;
    let itemsPerView = getItemsPerView();
    let currentPosition = 0;
    let isAnimating = false;

    function getItemsPerView() {
        return window.innerWidth <= 767 ? 2 : 4;
    }

    window.addEventListener('resize', function() {
        itemsPerView = getItemsPerView();
        currentPosition = 0; // Reset position on resize
        updateSliderView();
    });

    function calculateTotalSlides() {
        return Math.ceil(itemCount / itemsPerView);
    }

    function getCurrentSlideItems() {
        const currentSlide = Math.floor(currentPosition / itemsPerView);
        const start = currentSlide * itemsPerView;
        const end = Math.min(start + itemsPerView, itemCount);
        return { start, end };
    }

    function updateSliderView(callback) {
        const { start, end } = getCurrentSlideItems();

        items.forEach((item, index) => {
            // Only show items in the current slide range
            if (index >= start && index < end) {
                item.style.display = 'block';
                item.style.opacity = '0';
                setTimeout(() => {
                    item.style.transition = 'opacity 0.5s';
                    item.style.opacity = '1';
                }, 50);
            } else {
                item.style.display = 'none';
            }
        });

        // Update button visibility
        const isFirstSlide = currentPosition === 0;
        const isLastSlide = end >= itemCount;

        prevBtn.style.display = isFirstSlide ? 'none' : 'block';
        nextBtn.style.display = isLastSlide ? 'none' : 'block';

        if (callback) callback();
    }

    prevBtn.addEventListener('click', () => {
        if (!isAnimating && currentPosition > 0) {
            isAnimating = true;
            currentPosition = Math.max(currentPosition - itemsPerView, 0);
            updateSliderView(() => {
                isAnimating = false;
            });
        }
    });

    nextBtn.addEventListener('click', () => {
        if (!isAnimating && currentPosition + itemsPerView < itemCount) {
            isAnimating = true;
            currentPosition += itemsPerView;
            updateSliderView(() => {
                isAnimating = false;
            });
        }
    });

    // Initial update
    updateSliderView();
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
function changeVariantActive(button, insidingId) {
    const variantsContainer = document.querySelector(`[data-insiding-id="${insidingId}"]`);
    const variantButtons = variantsContainer.querySelectorAll('.variant-button');

    // Remove 'active' class from all buttons and reset 'data-selected'
    variantButtons.forEach((btn) => {
        btn.classList.remove('active');
        btn.removeAttribute('data-selected');
    });

    // Add 'active' class to the clicked button and mark it as selected
    button.classList.add('active');
    button.setAttribute('data-selected', 'true');
}

function previewImage(event, id) {
    const input = event.target;
    const label = document.querySelector(`#image-preview-${id}`);
    const img = document.querySelector(`#image-preview-img-${id}`);
    const errorMessage = input.closest('.flex-column').querySelector('.error-message');

    // Dosya seçilmiş mi kontrol ediyoruz
    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Dosya boyutu kontrolü (örneğin 5MB)
        const maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
            errorMessage.textContent = 'Şəkil həcmi 5MB-dan çox olmamalıdır';
            errorMessage.style.display = 'block';
            input.value = ''; // Input'u temizle
            return;
        }

        // Dosya tipi kontrolü
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/heic'];
        if (!allowedTypes.includes(file.type.toLowerCase()) &&
            !file.name.toLowerCase().endsWith('.heic')) {
            errorMessage.textContent = 'Yalnız şəkil faylları yükləyə bilərsiniz';
            errorMessage.style.display = 'block';
            input.value = ''; // Input'u temizle
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            // Önizleme resmini göster
            img.src = e.target.result;
            img.style.display = 'block';
            label.style.display = 'none';

            // Hata mesajını gizle
            errorMessage.style.display = 'none';
        };

        reader.onerror = function() {
            errorMessage.textContent = 'Şəkil oxunarkən xəta baş verdi';
            errorMessage.style.display = 'block';
            input.value = ''; // Input'u temizle
        };

        reader.readAsDataURL(file);
    } else {
        // Resim seçimi iptal edildiğinde
        img.src = '';
        img.style.display = 'none';
        label.style.display = 'block';
        errorMessage.style.display = 'none';
    }
}

// Tüm yüklenen resimleri toplamak için yardımcı fonksiyon
function getAllUploadedImages() {
    const uploadedImages = [];
    const inputs = document.querySelectorAll('.dynamic-image-upload');

    inputs.forEach(input => {
        if (input.files && input.files[0]) {
            uploadedImages.push({
                file: input.files[0],
                insidingId: input.dataset.insidingId,
                uploadIndex: input.dataset.uploadIndex
            });
        }
    });

    return uploadedImages;
}

document.addEventListener('DOMContentLoaded', function () {
    const boxItems = document.querySelectorAll('.box-item');
    const prevButton = document.querySelector('.boxes-prev');
    const nextButton = document.querySelector('.boxes-next');

    const itemsPerSlide = 4;
    const totalItems = boxItems.length;
    let currentIndex = 0;

    // İlk yüklemede prev butonunu gizle
    if (prevButton) prevButton.style.display = totalItems <= 4 ? 'none' : 'none';
    if (nextButton) nextButton.style.display = totalItems <= 4 ? 'none' : 'flex';

    const showItems = (startIndex) => {
        // Tüm öğeleri gizle
        boxItems.forEach(item => {
            item.style.display = 'none';
        });

        // Sadece gösterilmesi gereken öğeleri göster
        for (let i = startIndex; i < Math.min(startIndex + itemsPerSlide, totalItems); i++) {
            boxItems[i].style.display = 'block';
        }

        // Butonların görünürlüğünü güncelle
        if (prevButton) prevButton.style.display = startIndex === 0 ? 'none' : 'flex';
        if (nextButton) nextButton.style.display = startIndex + itemsPerSlide >= totalItems ? 'none' : 'flex';
    };

    if (nextButton) {
        nextButton.addEventListener('click', () => {
            if (currentIndex + itemsPerSlide < totalItems) {
                currentIndex += itemsPerSlide;
                showItems(currentIndex);
            }
        });
    }

    if (prevButton) {
        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex -= itemsPerSlide;
                showItems(currentIndex);
            }
        });
    }

    // İlk yükleme
    showItems(0);
});

document.addEventListener('DOMContentLoaded', function () {
    const giftBoxImages = document.querySelectorAll('.gift-box-img');

    giftBoxImages.forEach(img => {
        img.addEventListener('click', function () {
            giftBoxImages.forEach(image => {
                image.classList.remove('active');
            });

            this.classList.add('active');

            const boxId = this.getAttribute('data-box-id');
            console.log('Selected box ID:', boxId);
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const fontButtons = document.querySelectorAll('.font-button-customizing-edit');

    fontButtons.forEach(button => {
        button.addEventListener('click', function () {
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

function validateForm() {
    let isValid = true;
    const errorMessages = document.querySelectorAll('.error-message');

    // Tüm hata mesajlarını gizle
    errorMessages.forEach(msg => msg.style.display = 'none');

    // Kutu seçimi kontrolü
    const selectedBox = document.querySelector('.gift-box-img.selected');
    if (!selectedBox) {
    const boxErrorMsg = document.querySelector('.boxes-slider-container').nextElementSibling;
    boxErrorMsg.style.display = 'block';
    isValid = false;
}

    // Kart seçimi kontrolü
    const selectedCard = document.querySelector('#selected-card-image');
    if (!selectedCard.src || selectedCard.style.display === 'none') {
    const cardErrorMsg = document.querySelector('.slider-container').nextElementSibling;
    cardErrorMsg.style.display = 'block';
    isValid = false;
}

    // Qutu yazısı kontrolü
    const boxText = document.querySelector('.customizing-text-input-fonts');
    if (!boxText.value.trim()) {
    boxText.nextElementSibling.style.display = 'block';
    isValid = false;
}

    // Font seçimi kontrolü
    const selectedFont = document.querySelector('.font-button-customizing-edit.active');
    if (!selectedFont) {
    document.querySelector('.button-group-customizing-fonts')
    .nextElementSibling.style.display = 'block';
    isValid = false;
}

    // Form alanları kontrolü
    ['to-field', 'from-field', 'message-field'].forEach(fieldId => {
    const field = document.getElementById(fieldId);
    if (!field.value.trim()) {
    field.nextElementSibling.style.display = 'block';
    isValid = false;
}
});

    // Dinamik textarea kontrolü
    document.querySelectorAll('.dynamic-textarea').forEach(textarea => {
    if (!textarea.value.trim()) {
    const errorMsg = textarea.nextElementSibling;
    errorMsg.style.display = 'block';
    isValid = false;
}
});

    // Dinamik resim yükleme kontrolü
    document.querySelectorAll('.dynamic-image-upload').forEach(input => {
    const insidingId = input.dataset.insidingId;
    const previewImg = document.querySelector(`#image-preview-img-${insidingId}`);

    if (!previewImg.src || previewImg.style.display === 'none') {
    const errorMsg = input.closest('.flex-column').querySelector('.error-message');
    errorMsg.style.display = 'block';
    isValid = false;
}
});

    // Dinamik variant seçimi kontrolü
    document.querySelectorAll('.variants-buttons').forEach(variantGroup => {
    const hasActiveVariant = variantGroup.querySelector('.variant-button.active');
    if (!hasActiveVariant) {
    const errorMsg = variantGroup.nextElementSibling;
    errorMsg.style.display = 'block';
    isValid = false;
}
});

    if (!isValid) {
    alert('Zəhmət olmasa bütün tələb olunan sahələri doldurun!');
}

    return isValid;
}

    // Variant seçimi için fonksiyon
    function changeVariantActive(button, insidingId) {
    // Aynı grup içindeki tüm butonlardan active sınıfını kaldır
    const variantGroup = button.closest('.variants-buttons');
    variantGroup.querySelectorAll('.variant-button').forEach(btn => {
    btn.classList.remove('active');
});

    // Tıklanan butona active sınıfını ekle
    button.classList.add('active');

    // Hata mesajını gizle
    const errorMsg = variantGroup.nextElementSibling;
    if (errorMsg && errorMsg.classList.contains('error-message')) {
    errorMsg.style.display = 'none';
}
}

    // Resim önizleme fonksiyonu
    function previewImage(event, insidingId) {
    const file = event.target.files[0];
    if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
    const preview = document.querySelector(`#image-preview-${insidingId}`);
    const previewImg = document.querySelector(`#image-preview-img-${insidingId}`);

    preview.style.display = 'none';
    previewImg.src = e.target.result;
    previewImg.style.display = 'block';

    // Hata mesajını gizle
    const errorMsg = event.target.closest('.flex-column').querySelector('.error-message');
    if (errorMsg) {
    errorMsg.style.display = 'none';
}
}
    reader.readAsDataURL(file);
}
}

    // Sayfa yüklendiğinde
    document.addEventListener('DOMContentLoaded', function() {
    // Form gönderilmeden önce kontrol et
    const form = document.querySelector('form');
    if (form) {
    form.addEventListener('submit', function(e) {
    if (!validateForm()) {
    e.preventDefault();
}
});
}

    // Input alanları değiştiğinde hata mesajını gizle
    document.querySelectorAll('input, textarea').forEach(element => {
    element.addEventListener('input', function() {
    const errorMessage = this.nextElementSibling;
    if (errorMessage && errorMessage.classList.contains('error-message')) {
    errorMessage.style.display = 'none';
}
});
});

    // Dinamik textarea değişikliklerini dinle
    document.querySelectorAll('.dynamic-textarea').forEach(textarea => {
    textarea.addEventListener('input', function() {
    const errorMsg = this.nextElementSibling;
    if (errorMsg && errorMsg.classList.contains('error-message')) {
    errorMsg.style.display = 'none';
}
});
});

    // Font seçimi değişikliklerini dinle
    document.querySelectorAll('.font-button-customizing-edit').forEach(button => {
    button.addEventListener('click', function() {
    const errorMsg = this.closest('.button-group-customizing-fonts').nextElementSibling;
    if (errorMsg && errorMsg.classList.contains('error-message')) {
    errorMsg.style.display = 'none';
}
});
});

    // Kutu seçimi için event listener
    document.querySelectorAll('.gift-box-img').forEach(box => {
    box.addEventListener('click', function() {
    // Diğer kutulardan selected class'ını kaldır
    document.querySelectorAll('.gift-box-img').forEach(b => b.classList.remove('selected'));
    // Seçilen kutuya selected class'ı ekle
    this.classList.add('selected');
    // Hata mesajını gizle
    const errorMsg = document.querySelector('.boxes-slider-container').nextElementSibling;
    if (errorMsg && errorMsg.classList.contains('error-message')) {
    errorMsg.style.display = 'none';
}
});
});

    // Kart seçimi için event listener
//     document.querySelectorAll('.select-card').forEach(card => {
//     card.addEventListener('click', function() {
//     // Hata mesajını gizle
//     const errorMsg = document.querySelector('.slider-container').nextElementSibling;
//     if (errorMsg && errorMsg.classList.contains('error-message')) {
//     errorMsg.style.display = 'none';
// }
// });
// });

    // Reset slider için event listener
//     document.getElementById('reset-slider')?.addEventListener('click', function() {
//     // Kart seçimi sıfırlandığında hata mesajını göster
//     const errorMsg = document.querySelector('.slider-container').nextElementSibling;
//     if (errorMsg && errorMsg.classList.contains('error-message')) {
//     errorMsg.style.display = 'block';
// }
// });
});
