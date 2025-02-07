// Helper function for showing SweetAlert messages
async function showAlert(options) {
    return await Swal.fire({
        ...options,
        confirmButtonColor: '#167c07',
        cancelButtonColor: '#d33'
    });
}

// Check if box is selected
async function checkBoxSelected() {
    try {
        const response = await fetch('/session/check-box', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const data = await response.json();
        console.log('Box selected response:', data); // Debug için log ekleyelim
        return data.has_box; // Burada 'has_box' kullanılıyor
    } catch (error) {
        console.error('Error checking box selected:', error);
        return false;
    }
}

// Enhanced error handling function
async function handleError(error, specificMessage = null) {
    const message = specificMessage;
    await showAlert({
        icon: 'error',
        title: 'Xəta!',
        text: message
    });
}

// Success message function
async function showSuccess(message = 'Məhsul uğurla əlavə edildi!') {
    await showAlert({
        icon: 'success',
        title: 'Uğurlu!',
        text: message,
        showConfirmButton: false,
        timer: 1500
    });
}

// Error alert function
async function showError(message) {
    await showAlert({
        icon: 'error',
        title: 'Xəta!',
        text: message,
        showConfirmButton: true
    });
}

document.querySelectorAll('.choose-box-circle').forEach(circle => {
    circle.addEventListener('click', function (e) {
        const step = this.textContent.trim();
        window.location.href = `/choose-step/${step}`;
    });
});

document.addEventListener('DOMContentLoaded', function() {

    // Check text length and hide show more button if not needed
    document.querySelectorAll('.variant-paragraph').forEach(container => {
        const fullText = container.getAttribute('data-full-text');
        const showMoreBtn = container.querySelector('.show-more-btn');

        if (fullText.length <= 200) {
            showMoreBtn.style.display = 'none';
        }
    });
});

function toggleText(elementId) {
    const container = document.getElementById(elementId);
    if (!container) return; // Safety check

    const content = container.querySelector('.content');
    const showMoreBtn = container.querySelector('.show-more-btn');
    const fullText = container.getAttribute('data-full-text');

    const isExpanded = showMoreBtn.textContent === 'Show less';

    if (isExpanded) {
        content.textContent = fullText.substring(0, 200) + ' ...';
        showMoreBtn.textContent = 'Show more';
    } else {
        content.textContent = fullText;
        showMoreBtn.textContent = 'Show less';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Handle Choose Variant button clicks
    document.querySelectorAll('.choose-variant-button').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();

            const modal = this.closest('.modal');
            const itemId = modal.id.split('-')[1]; // Get item ID from modal-{id}

            // Get variant and text data
            const selectedVariant = modal.querySelector('.variant-button.active');
            const customText = modal.querySelector('.custom-text')?.value;

            // Create form data
            const formData = new FormData();
            formData.append('choose_item_id', itemId);
            formData.append('selected_variant', selectedVariant?.textContent.trim() || null);
            formData.append('variant_price', selectedVariant?.dataset.price || null);
            formData.append('user_text', customText || null);

            try {
                // Show loading state
                Swal.fire({
                    title: 'Zəhmət olmasa gözləyin...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const response = await fetch('/session/save-item', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    // Modal bağlanmadan öncə kiçik gecikmə əlavə edək
                    setTimeout(() => {
                        // Close the modal
                        bootstrap.Modal.getInstance(modal).hide();
                        showSuccess("Məhsul uğurla əlavə edildi!").then(() => {
                            window.location.reload();

                            // Get the next step route from the button's original onclick attribute
                            const nextStepRoute = button.getAttribute('onclick')
                                ?.replace("window.location.href='", "")
                                ?.replace("'", "");

                            if (nextStepRoute) {
                                window.location.href = nextStepRoute;
                            }
                        });
                    }, 500);
                } else if (result.error_code === 'NO_BOX_SELECTED') {
                    await showError('Zəhmət olmasa əvvəlcə qutu seçin!');
                } else if (result.error_code === 'TOO_LARGE') {
                    await showError('Bu məhsul qutuya sığmır. Zəhmət olmasa daha kiçik məhsul seçin və ya başqa qutu seçin.');
                } else {
                    await showError(result.message || 'Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.');
                }
            } catch (error) {
                handleError(error);
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Add this inside your DOMContentLoaded event listener
    document.querySelectorAll('.choose-box-choose-button').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();

            // Get the modal element
            const modal = this.closest('.modal');
            const itemId = modal.id.split('_')[1];


            // Get all customization data
            const customText = modal.querySelector('.custom-text')?.value;
            const selectedVariant = modal.querySelector('.variant-button.active')?.textContent.trim();
            const selectedVariantPrice = modal.querySelector('.variant-button.active')?.dataset.price;

            // Get uploaded files if they exist
            const uploadedFiles = getUploadedFiles(itemId);

            // Create FormData object to handle file uploads
            const formData = new FormData();

            // Add basic data
            formData.append('choose_item_id', itemId);
            formData.append('user_text', customText || null);
            formData.append('selected_variant', selectedVariant || null);
            formData.append('variant_price', selectedVariantPrice || null);

            // Add files if they exist
            uploadedFiles.forEach((file, index) => {
                formData.append(`uploaded_images[${index}]`, file);
            });
            console.log('Uploaded Files:', uploadedFiles);


            try {
                // Show loading state
                Swal.fire({
                    title: 'Zəhmət olmasa gözləyin...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const response = await saveCustomItemSelection(formData);

                if (response.success) {
                    // Modal bağlanmadan öncə kiçik gecikmə əlavə edək
                    setTimeout(() => {
                        // Close the modal
                        bootstrap.Modal.getInstance(modal).hide();
                        showSuccess("Məhsul uğurla əlavə edildi!").then(() => {
                            window.location.reload();
                        });
                    }, 500);
                } else if (response.error_code === 'NO_BOX_SELECTED') {
                    await showError('Zəhmət olmasa əvvəlcə qutu seçin!');
                } else if (response.error_code === 'TOO_LARGE') {
                    await showError('Bu məhsul qutuya sığmır. Zəhmət olmasa daha kiçik məhsul seçin və ya başqa qutu seçin.');
                } else {
                    await showError(response.message || 'Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.');
                }
            } catch (error) {
                handleError(error);
            }
        });
    });

// Function to send data to server
    async function saveCustomItemSelection(formData) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch('/session/save-item', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        });

        return await response.json();
    }




    document.querySelectorAll('.choose-items-button').forEach(button => {
        button.addEventListener('click', async function (e) {
            e.preventDefault();
            const buttonType = this.innerText.trim();

            // Əgər düymə növü "Choose variant" və ya "Custom Product"dirsə, modal açılır
            const modalId = this.getAttribute('data-bs-target');
            if (modalId && (buttonType === "Choose variant" || buttonType === "Custom Product")) {
                const modal = document.getElementById(modalId.replace('#', ''));
                if (modal) {
                    new bootstrap.Modal(modal).show();
                }
                return;
            }

            // Əgər düymə növü "Add to Box"dursa, məlumatları sessiyaya əlavə edir
            if (buttonType === "Add to Box") {
                const cardElement = this.closest('.card');
                const itemId = cardElement.getAttribute('data-item-id');
                const itemName = cardElement.querySelector('p').innerText.trim();
                const itemImage = cardElement.querySelector('.normal-image').getAttribute('src');
                const itemPrice = cardElement.querySelector('.text-muted').innerText.replace('₼', '').trim();

                try {
                    // Show loading state
                    Swal.fire({
                        title: 'Zəhmət olmasa gözləyin...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const response = await saveItemSelection({
                        choose_item_id: itemId,
                        item_name: itemName,
                        item_image: itemImage,
                        item_price: itemPrice,
                        user_text: null, // İstifadəçi mətn əlavə etmirsə
                        selected_variants: null // Variant seçimi yoxdursa
                    });

                    if (response.success) {
                        await showSuccess('Məhsul uğurla əlavə edildi!');
                        window.location.reload();
                    } else if (response.error_code === 'NO_BOX_SELECTED') {
                        await showError('Zəhmət olmasa əvvəlcə qutu seçin!');
                    } else if (response.error_code === 'TOO_LARGE') {
                        await showError('Bu məhsul qutuya sığmır. Zəhmət olmasa daha kiçik məhsul seçin və ya başqa qutu seçin.');
                    } else {
                        await showError(response.message || 'Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.');
                    }
                } catch (error) {
                    handleError(error);
                }
            }
        });
    });

// AJAX ilə sessiyaya məlumatları göndərən funksiya
    async function saveItemSelection(data) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch('/session/save-item', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        });

        return await response.json();
    }

    // Function to reset modal state
    function resetModalState() {
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
        document.body.classList.remove('modal-open');
        document.body.style.paddingRight = '';
    }

    // Enhanced openCustomizationModal function
    window.openCustomizationModal = function(itemId) {
        // Close the preview modal
        const previewModal = document.getElementById(`productPreviewModal_${itemId}`);
        if (previewModal) {
            bootstrap.Modal.getInstance(previewModal)?.hide();
        }

        // Reset state
        resetModalState();

        // Open customization modal
        const customModal = document.getElementById(`customizationModal_${itemId}`);
        if (customModal) {
            new bootstrap.Modal(customModal).show();
        }
    };

    // Handle modal closing
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            resetModalState();
        });

        // Handle backdrop clicks
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                bootstrap.Modal.getInstance(this)?.hide();
            }
        });
    });

    // Handle ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const openModal = document.querySelector('.modal.show');
            if (openModal) {
                bootstrap.Modal.getInstance(openModal)?.hide();
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Helper function to create error message element
    function createErrorMessage(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.style.display = 'block';
        errorDiv.style.fontSize = '12px';
        errorDiv.style.color = '#dc3545';
        errorDiv.style.marginTop = '5px';
        errorDiv.textContent = message;
        return errorDiv;
    }

    // Helper function to add validation to an input
    function addValidation(element, errorMessage) {
        if (!element) return;

        element.classList.add('form-control');
        element.setAttribute('required', '');

        element.addEventListener('input', () => {
            validateElement(element, errorMessage);
        });
    }

    // Helper function to validate a single element
    function validateElement(element, errorMessage) {
        const existingError = element.nextElementSibling;
        if (existingError && existingError.classList.contains('invalid-feedback')) {
            existingError.remove();
        }

        if (!element.value.trim()) {
            element.classList.add('is-invalid');
            element.style.borderColor = '#dc3545';
            const error = createErrorMessage(errorMessage);
            element.parentNode.insertBefore(error, element.nextSibling);
            return false;
        } else {
            element.classList.remove('is-invalid');
            element.style.borderColor = '';
            return true;
        }
    }

    // Helper function to validate variant selection
    function validateVariantSelection(variantButtons, errorMessage) {
        const variantContainer = variantButtons[0]?.closest('.variants-buttons');
        if (!variantContainer) return true;

        const existingError = variantContainer.nextElementSibling;
        if (existingError && existingError.classList.contains('invalid-feedback')) {
            existingError.remove();
        }

        let isSelected = false;
        variantButtons.forEach(button => {
            if (button.classList.contains('active')) {
                isSelected = true;
            }
        });

        if (!isSelected) {
            variantContainer.style.borderColor = '#dc3545';
            variantContainer.style.borderWidth = '1px';
            variantContainer.style.borderStyle = 'solid';
            variantContainer.style.borderRadius = '8px';
            variantContainer.style.padding = '10px';
            const error = createErrorMessage(errorMessage);
            variantContainer.parentNode.insertBefore(error, variantContainer.nextSibling);
            return false;
        } else {
            variantContainer.style.borderColor = '';
            variantContainer.style.borderWidth = '';
            variantContainer.style.borderStyle = '';
            variantContainer.style.padding = '';
            return true;
        }
    }

    // Validate Custom Product Modal
    document.querySelectorAll('[id^="customizationModal_"]').forEach(modal => {
        const customText = modal.querySelector('.custom-text');
        const imageUploads = modal.querySelectorAll('.hidden-input');
        const variantButtons = modal.querySelectorAll('.variant-button');
        const addToBoxButton = modal.querySelector('.choose-box-choose-button');

        if (customText) {
            addValidation(customText, 'Bu sahəni doldurmaq məcburidir');
        }

        if (imageUploads.length > 0) {
            imageUploads.forEach(upload => {
                upload.setAttribute('required', '');
            });
        }

        if (addToBoxButton) {
            addToBoxButton.addEventListener('click', (e) => {
                let isValid = true;

                if (customText && !validateElement(customText, 'Bu sahəni doldurmaq məcburidir')) {
                    isValid = false;
                }

                if (variantButtons.length > 0 && !validateVariantSelection(variantButtons, 'Variant seçimi məcburidir')) {
                    isValid = false;
                }

                if (imageUploads.length > 0) {
                    let hasOneImage = false;
                    imageUploads.forEach(upload => {
                        if (upload.files.length > 0) hasOneImage = true;
                    });

                    if (!hasOneImage) {
                        const uploadContainer = modal.querySelector('.upload-container');
                        if (uploadContainer) {
                            const existingError = uploadContainer.nextElementSibling;
                            if (existingError?.classList.contains('invalid-feedback')) {
                                existingError.remove();
                            }
                            uploadContainer.style.borderColor = '#dc3545';
                            const error = createErrorMessage('Ən az bir şəkil yükləmək məcburidir');
                            uploadContainer.parentNode.insertBefore(error, uploadContainer.nextSibling);
                            isValid = false;
                        }
                    }
                }

                if (!isValid) {
                    e.preventDefault();
                    return false;
                }
            });
        }
    });

    // Validate Choose Variant Modal
    document.querySelectorAll('[id^="modal-"]').forEach(modal => {
        if (!modal.id.startsWith('modal-customization')) {
            const customText = modal.querySelector('.custom-text');
            const variantButtons = modal.querySelectorAll('.variant-button');
            const addToBoxButton = modal.querySelector('.choose-box-choose-button');

            if (customText) {
                addValidation(customText, 'Bu sahəni doldurmaq məcburidir');
            }

            // Add click event listeners for variant buttons
            variantButtons.forEach(button => {
                button.addEventListener('click', () => {
                    validateVariantSelection(variantButtons, 'Variant seçimi məcburidir');
                });
            });

            if (addToBoxButton) {
                addToBoxButton.addEventListener('click', (e) => {
                    let isValid = true;

                    if (customText && !validateElement(customText, 'Bu sahəni doldurmaq məcburidir')) {
                        isValid = false;
                    }

                    if (variantButtons.length > 0 && !validateVariantSelection(variantButtons, 'Variant seçimi məcburidir')) {
                        isValid = false;
                    }

                    if (!isValid) {
                        e.preventDefault();
                        return false;
                    }
                });
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.choose_items');
    const searchBox = document.getElementById('search-box');
    const sortSelect = document.getElementById('sort-boxes');

    let activeFilters = {
        category: null,
        production_time: null,
        price: {
            min: null,
            max: null
        }
    };

    // Arama fonksiyonu
    searchBox.addEventListener('input', function() {
        applyFilters();
    });

    // Sıralama fonksiyonu
    sortSelect.addEventListener('change', function() {
        const itemsArray = Array.from(items);
        const sortValue = this.value;

        itemsArray.sort((a, b) => {
            const getPrice = (element) => {
                return parseFloat(element.querySelector('.text-muted').textContent.replace('₼', '').trim());
            };

            const getName = (element) => {
                return element.querySelector('p').textContent.trim();
            };

            switch(sortValue) {
                case 'price_asc':
                    return getPrice(a) - getPrice(b);
                case 'price_desc':
                    return getPrice(b) - getPrice(a);
                case 'name_asc':
                    return getName(a).localeCompare(getName(b));
                case 'name_desc':
                    return getName(b).localeCompare(getName(a));
                default:
                    return 0;
            }
        });

        const container = items[0].parentElement;
        itemsArray.forEach(item => container.appendChild(item));
    });

    // Filter butonları için event listener
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filterType = this.dataset.filter;
            const filterValue = this.dataset.value;

            // Toggle active class
            if (filterType !== 'price') {
                if (activeFilters[filterType] === filterValue) {
                    // Aynı butona tekrar tıklandıysa filtreyi kaldır
                    activeFilters[filterType] = null;
                    this.classList.remove('active');
                } else {
                    // Diğer butonlardan active class'ı kaldır
                    document.querySelectorAll(`.filter-btn[data-filter="${filterType}"]`)
                        .forEach(btn => btn.classList.remove('active'));

                    // Yeni filtre değerini ata ve butonu aktif yap
                    activeFilters[filterType] = filterValue;
                    this.classList.add('active');
                }
            } else {
                // Fiyat filtresi için
                const minPrice = parseFloat(document.getElementById('min-price').value) || null;
                const maxPrice = parseFloat(document.getElementById('max-price').value) || null;

                activeFilters.price = {
                    min: minPrice,
                    max: maxPrice
                };
            }

            applyFilters();
        });
    });

    function applyFilters() {
        const searchTerm = searchBox.value.toLowerCase();

        items.forEach(item => {
            let shouldShow = true;

            // Arama filtresi
            const itemName = item.querySelector('p').textContent.toLowerCase();
            const companyName = item.querySelector('h5').textContent.toLowerCase();
            if (searchTerm && !itemName.includes(searchTerm) && !companyName.includes(searchTerm)) {
                shouldShow = false;
            }

            // Category filter
            if (shouldShow && activeFilters.category !== null) {
                shouldShow = item.dataset.recipient === activeFilters.category;
            }

            // Price filter
            if (shouldShow && (activeFilters.price.min !== null || activeFilters.price.max !== null)) {
                const priceText = item.querySelector('.text-muted').textContent;
                const price = parseFloat(priceText.replace('₼', '').trim());

                if (activeFilters.price.min !== null && price < activeFilters.price.min) {
                    shouldShow = false;
                }
                if (activeFilters.price.max !== null && price > activeFilters.price.max) {
                    shouldShow = false;
                }
            }

            // Production time filter
            if (shouldShow && activeFilters.production_time !== null) {
                shouldShow = item.dataset.production_time === activeFilters.production_time;
            }

            // Update visibility
            item.style.display = shouldShow ? '' : 'none';
        });
    }

    // Reset filters button
    const resetButton = document.createElement('button');
    resetButton.textContent = 'Filtrleri Sıfırla';
    resetButton.className = 'filter-btn mt-3 w-100 fs-6';
    resetButton.addEventListener('click', function() {
        activeFilters = {
            category: null,
            production_time: null,
            price: {
                min: null,
                max: null
            }
        };

        // Reset all active classes
        filterButtons.forEach(btn => btn.classList.remove('active'));

        // Reset price inputs
        document.getElementById('min-price').value = '';
        document.getElementById('max-price').value = '';

        // Reset search box
        searchBox.value = '';

        // Reset sort select
        sortSelect.value = 'default';

        // Show all items
        items.forEach(item => item.style.display = '');
    });

    // Add reset button to filters container
    document.querySelector('.filters').appendChild(resetButton);
});

// Ümumi funksiyalar və event handler'lar(Check Box and item volume)
async function checkBoxVolume(itemId) {
    try {
        const response = await fetch('/check-box-volume', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ item_id: itemId })
        });

        if (!response.ok) throw new Error('Network response was not ok');
        return await response.json();
    } catch (error) {
        console.error('Check box volume error:', error);
        throw error;
    }
}

async function saveItemSelection(itemId, variantPrice = null, selectedVariant = null, userText = null) {
    const formData = new FormData();
    formData.append('choose_item_id', itemId);

    if (variantPrice) formData.append('variant_price', variantPrice);
    if (selectedVariant) formData.append('selected_variant', selectedVariant);
    if (userText) formData.append('user_text', userText);

    const response = await fetch('/save-item-selection', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: formData,
    });

    if (!response.ok) {
        throw new Error(`Save item failed. Status: ${response.status}`);
    }

    return await response.json();
}

async function handleAddToBox(itemId, variantPrice = null, selectedVariant = null, userText = null) {
    const isBoxSelected = await checkBoxSelected();
    console.log('Is box selected:', isBoxSelected); // Debug için log
    if (!isBoxSelected) {
        await handleError(null, ERROR_MESSAGES.NO_BOX_SELECTED);
        return false;
    }

    const volumeCheck = await checkBoxVolume(itemId);
    if (!volumeCheck.success) {
        await handleError(null, ERROR_MESSAGES.BOX_TOO_SMALL);
        return false;
    }

    const saveData = await saveItemSelection(itemId, variantPrice, selectedVariant, userText);
    if (saveData.success) {
        await showSuccess();
        location.reload();
    } else {
        await handleError(saveData.message);
    }

}

function setupEventListeners() {
    // Adi məhsullar üçün buton click
    document.querySelectorAll('.choose-items-button').forEach((button) => {
        button.addEventListener('click', function () {
            const itemId = this.closest('.card').dataset.itemId;
            handleAddToBox(itemId);
        });
    });

    // Variant seçimi tələb edən məhsullar üçün buton click
    document.querySelectorAll('.choose-variant-button').forEach((button) => {
        button.addEventListener('click', function () {
            const modal = this.closest('.modal');
            const card = modal.previousElementSibling;
            const itemId = card.dataset.itemId;

            const activeVariant = modal.querySelector('.variant-button.active');
            const variantPrice = activeVariant ? activeVariant.dataset.price : null;
            const selectedVariant = activeVariant ? activeVariant.textContent.trim() : null;

            const customText = modal.querySelector('.custom-text');
            const userText = customText ? customText.value : null;

            handleAddToBox(itemId, variantPrice, selectedVariant, userText);
        });
    });

    // Xüsusi seçim tələb edən məhsullar üçün buton click
    document.querySelectorAll('.choose-box-choose-button').forEach((button) => {
        button.addEventListener('click', function () {
            const modal = this.closest('.modal');
            const itemId = modal.id.split('_')[1];

            const activeVariant = modal.querySelector('.variant-button.active');
            const variantPrice = activeVariant ? activeVariant.dataset.price : null;
            const selectedVariant = activeVariant ? activeVariant.textContent.trim() : null;

            const customText = modal.querySelector('.custom-text');
            const userText = customText ? customText.value : null;

            handleAddToBox(itemId, variantPrice, selectedVariant, userText);
        });
    });
}

// Document hazır olduqda eventi quraşdır
document.addEventListener('DOMContentLoaded', setupEventListeners);
