@extends('front.layouts.app')
@section('title', __('Hədiyyə Qutusu Yaradın | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-a-cart.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}?v={{ time() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @php
        $hideFooter = true;
    @endphp

    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
        @foreach (range(1, 4) as $stepNumber)
            <div class="choose-box-step">
                @if ($stepNumber < 4 || session('currentStep') >= $stepNumber) {{-- Adım tamamlanmadığı sürece ilerleme yapılamaz --}}
                <a href="{{ route('choose.step', $stepNumber) }}"
                   style="text-decoration: none"
                   class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">
                    {{ $stepNumber }}
                </a>
                @else
                    <span
                        class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}"
                        style="cursor: not-allowed;">
                    {{ $stepNumber }}
                </span>
                @endif
                    <div class="choose-box-text d-flex justify-content-center align-items-center">
                        <h3 class="choose-box-title">{{ ['Qutu Seçin', 'Əşyaları Seçin', 'Kart Seçin', 'Tamamlandı'][$stepNumber - 1] }}</h3>
                    </div>
            </div>
        @endforeach
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff;  border: 1px solid #ccc; max-width: 95%; margin-bottom: 90px!important;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Uyğun Kartı Seçin</h3>
            <p style="font-size: 14px; color: #898989">Komandamız bir sıra xüsusi tədbirlər üçün eksklüziv kart dizaynlarını hazırlayıb.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Seçdiyiniz kartın dizaynını seçin və özəlləşdirin!</p>
        </div>
        <div class="row gy-4 mt-4">
            @foreach ($cards as $card)
                <div class="col-md-3 col-6 card-col">
                    <div class="card gift-cards d-flex justify-content-center align-items-center w-100 h-100"
                         style="border: none;"
                         data-bs-toggle="modal"
                         data-bs-target="#modal-{{ $card->id }}">
                        <div class="gift-card-image">
                            <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->name }}"
                                 style="object-fit: cover; border-radius: 10px;">
                        </div>
                        <div class="card-body ">
                            <h5 class="card-title" style="font-size: 16px; color: #a3907a;">{{ $card->name }}</h5>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-{{ $card->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $card->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px;">
                        <div class="modal-content rounded-4">
                            <div class="modal-body p-4">
                                <div class="d-flex align-items-start gap-4">
                                    <!-- Image Section - will be toggled -->
                                    <div class="position-relative image-section" style="width: 360px; flex-shrink: 0;">
                                        <div style="height: 320px; width: 360px; overflow: hidden;">
                                            <img src="{{ asset('storage/' . $card->image) }}"
                                                 class="d-block w-100 h-100 object-fit-cover rounded-4"
                                                 alt="{{ $card->name }}">
                                        </div>
                                    </div>

                                    <!-- Preview Section - initially hidden -->
                                    <div class="preview-section position-relative" style="width: 360px; flex-shrink: 0; display: none;">
                                        <div style="height: 320px; width: 360px; overflow: hidden; background: #fff; border: 1px solid #e0e0e0; border-radius: 16px; padding: 20px;">
                                            <div class="preview-content" style="height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                                <p class="preview-recipient" style="font-size: 18px; color: #212529; margin-bottom: 10px; font-weight: 500;"></p>
                                                <p class="preview-message" style="font-size: 14px; color: #666; white-space: pre-wrap;"></p>
                                                <p class="preview-sender" style="font-size: 16px; color: #212529; margin-bottom: 15px;"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Details Section -->
                                    <div class="flex-grow-1">
                                        <h5 class="card-name" style="color: #a3907a; font-size: 21px; font-weight: 600;">
                                            {{ $card->name }}
                                        </h5>
                                        <p style="font-size: 14px; color: #898989; margin-bottom: 40px; font-weight: 500">₼{{ $card->price }}</p>
                                        <form class="card-form">
                                            <div style="margin-bottom: 15px; width: 100%;">
                                                <label for="recipient-name-{{ $card->id }}" style="color: #212529; font-size: 14px; display: flex; margin-bottom: 8px">Recipient Name</label>
                                                <input type="text" id="recipient-name-{{ $card->id }}" class="form-control recipient-name" style="width: 100% !important; height: 36px; padding: 10px; min-width: 100%;">
                                            </div>
                                            <div style="margin-bottom: 15px; width: 100%;">
                                                <label for="sender-name-{{ $card->id }}" style="color: #212529; font-size: 14px; display: flex; margin-bottom: 8px">Sender Name</label>
                                                <input type="text" id="sender-name-{{ $card->id }}" class="form-control sender-name" style="width: 100% !important; height: 36px; padding: 10px; min-width: 100%;">
                                            </div>
                                            <div style="margin-bottom: 15px; width: 100%;">
                                                <label for="card-content-{{ $card->id }}" style="color: #212529; font-size: 14px; display: flex; margin-bottom: 8px">Mesaj:</label>
                                                <textarea id="card-content-{{ $card->id }}" class="form-control card-content" rows="3" placeholder="Burada istədiyiniz mesajı yazın və ya boş buraxın" style="width: 100% !important; min-width: 100%; font-size: 12px; padding: 10px; resize: none;"></textarea>
                                            </div>
                                            <div style="margin-bottom: 20px;">
                                                <div style="display: flex; align-items: center; padding: 0; justify-content: flex-start; width: 100%;">
                                                    <input type="checkbox" id="leave-empty-{{ $card->id }}" class="leave-empty" style="margin: 0; accent-color: #a3907a; width: auto !important; min-width: auto !important;">
                                                    <label for="leave-empty-{{ $card->id }}" style="margin: 0 0 0 8px; color: #212529; font-size: 14px; white-space: nowrap;">Mesaj hissəni boş burax</label>
                                                </div>
                                            </div>
                                            <button type="button" id="save-card-selection save-card-{{ $card->id }}" class="btn btn-primary save-card save-card-selection"  data-card-id="{{ $card->id }}" style="font-size: 14px; width: 100% !important; height: 35px; line-height: 15px; padding: 10px; background-color: #a3907a; border: none; border-radius: 15px; margin-bottom: 10px;">Qutuya əlavə et</button>
                                            <button type="button" class="preview-toggle" style="background: none; border: none; color: #a3907a; width: 100%; text-align: center; font-size: 14px; cursor: pointer;">Baxış</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @include('front.build_a_box.selected-items-summary')
        <button class="complete-order-button" onclick="window.location.href='{{ route('order.complete') }}'">Sifarişi tamamla</button>

    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const modals = document.querySelectorAll('.modal');

        modals.forEach(modal => {
            const recipientInput = modal.querySelector('[id^="recipient-name"]');
            const senderInput = modal.querySelector('[id^="sender-name"]');
            const contentInput = modal.querySelector('[id^="card-content"]');
            const leaveEmptyCheckbox = modal.querySelector('[id^="leave-empty"]');
            const saveButton = modal.querySelector('[id^="save-card"]');
            const previewToggle = modal.querySelector('.preview-toggle');
            const imageSection = modal.querySelector('.image-section');
            const previewSection = modal.querySelector('.preview-section');

            // Preview elements
            const previewRecipient = modal.querySelector('.preview-recipient');
            const previewSender = modal.querySelector('.preview-sender');
            const previewMessage = modal.querySelector('.preview-message');

            if (!recipientInput || !senderInput || !contentInput || !leaveEmptyCheckbox || !saveButton) {
                console.error('Some elements not found in modal:', modal.id);
                return;
            }

            recipientInput.setAttribute('required', '');
            senderInput.setAttribute('required', '');
            contentInput.setAttribute('required', '');

            // Preview toggle functionality
            previewToggle.addEventListener('click', () => {
                if (imageSection.style.display !== 'none') {
                    imageSection.style.display = 'none';
                    previewSection.style.display = 'block';
                    previewToggle.textContent = 'Şəkilə bax';
                } else {
                    imageSection.style.display = 'block';
                    previewSection.style.display = 'none';
                    previewToggle.textContent = 'Baxış';
                }
            });

            // Real-time preview update
            function updatePreview() {
                previewRecipient.textContent = recipientInput.value || 'Recipient Name';
                previewSender.textContent = senderInput.value || 'Sender Name';
                previewMessage.textContent = leaveEmptyCheckbox.checked ? '' : (contentInput.value || 'Message');
            }

            function updateTextareaState() {
                if (leaveEmptyCheckbox.checked) {
                    contentInput.value = '';
                    contentInput.disabled = true;
                    contentInput.removeAttribute('required');
                } else {
                    contentInput.disabled = false;
                    contentInput.setAttribute('required', '');
                }
                updatePreview(); // Update preview when checkbox state changes
            }

            // Add event listeners for real-time preview
            recipientInput.addEventListener('input', updatePreview);
            senderInput.addEventListener('input', updatePreview);
            contentInput.addEventListener('input', updatePreview);
            leaveEmptyCheckbox.addEventListener('change', updateTextareaState);

            saveButton.addEventListener('click', (e) => {
                e.preventDefault();

                let isValid = true;

                if (!recipientInput.value.trim()) {
                    recipientInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    recipientInput.classList.remove('is-invalid');
                }

                if (!senderInput.value.trim()) {
                    senderInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    senderInput.classList.remove('is-invalid');
                }

                if (!leaveEmptyCheckbox.checked && !contentInput.value.trim()) {
                    contentInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    contentInput.classList.remove('is-invalid');
                }

                if (!isValid) {
                    return;
                }

                const cardData = {
                    recipient: recipientInput.value.trim(),
                    sender: senderInput.value.trim(),
                    content: leaveEmptyCheckbox.checked ? '' : contentInput.value.trim()
                };

                console.log('Card data:', cardData);

                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            });

            // Initialize preview and textarea state
            updateTextareaState();
            updatePreview();
        });
        // updateChooseBoxTitles fonksiyonu
        function updateChooseBoxTitles() {
            const titles = ["Qutu Seçin", "Əşyaları Seçin", "Kart Seçin", "Tamamlandı"];
            const shortTitles = ["Qutu", "Əşyalar", "Kart", "Tamamlandı"];

            const chooseBoxTitles = document.querySelectorAll(".choose-box-title");

            chooseBoxTitles.forEach((title, index) => {
                if (window.innerWidth <= 768) {
                    title.textContent = shortTitles[index];
                } else {
                    title.textContent = titles[index];
                }
            });
        }

// Sayfa yüklendiğinde ve pencere boyutu değiştiğinde fonksiyonu çağır
        window.addEventListener("resize", updateChooseBoxTitles);
        window.addEventListener("DOMContentLoaded", updateChooseBoxTitles);

        document.addEventListener("DOMContentLoaded", function () {
            updateChooseBoxTitles();
            window.addEventListener("resize", updateChooseBoxTitles);
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Handle Save Card button clicks
        document.querySelectorAll('.save-card-selection').forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();

                const modal = this.closest('.modal');
                const cardId = this.getAttribute('data-card-id');

                // Get form inputs
                const recipientInput = modal.querySelector('[id^="recipient-name"]');
                const senderInput = modal.querySelector('[id^="sender-name"]');
                const contentInput = modal.querySelector('[id^="card-content"]');
                const leaveEmptyCheckbox = modal.querySelector('[id^="leave-empty"]');

                // Validation
                let isValid = true;
                let errorMessages = [];

                if (!recipientInput.value.trim()) {
                    recipientInput.classList.add('is-invalid');
                    errorMessages.push('Alıcının adı tələb olunur');
                    isValid = false;
                } else {
                    recipientInput.classList.remove('is-invalid');
                }

                if (!senderInput.value.trim()) {
                    senderInput.classList.add('is-invalid');
                    errorMessages.push('Göndərənin adı tələb olunur');
                    isValid = false;
                } else {
                    senderInput.classList.remove('is-invalid');
                }

                if (!leaveEmptyCheckbox.checked && !contentInput.value.trim()) {
                    contentInput.classList.add('is-invalid');
                    errorMessages.push('Kart mesajı tələb olunur');
                    isValid = false;
                } else {
                    contentInput.classList.remove('is-invalid');
                }

                if (!isValid) {
                    Swal.fire({
                        title: 'Diqqət!',
                        html: errorMessages.join('<br>'),
                        icon: 'error',
                        confirmButtonText: 'Bağla'
                    });
                    return;
                }

                // Create form data
                const formData = new FormData();
                formData.append('card_id', cardId);
                formData.append('recipient_name', recipientInput.value.trim());
                formData.append('sender_name', senderInput.value.trim());
                formData.append('card_message', leaveEmptyCheckbox.checked ? '' : contentInput.value.trim());

                try {
                    // Show loading state
                    Swal.fire({
                        title: 'Zəhmət olmasa gözləyin...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const response = await fetch('/save-card-selection', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (result.success) {
                        // Close the modal
                        bootstrap.Modal.getInstance(modal).hide();

                        // Show success message
                        Swal.fire({
                            title: 'Uğurlu!',
                            text: 'Kart uğurla əlavə edildi!',
                            icon: 'success',
                            confirmButtonText: 'Tamam'
                        }).then(() => {
                            // Get the next step route if needed
                            const nextStepRoute = button.getAttribute('data-next-step');
                            if (nextStepRoute) {
                                window.location.href = nextStepRoute;
                            } else {
                                window.location.reload();
                            }
                        });
                    } else {
                        throw new Error(result.message || 'Xəta baş verdi');
                    }
                } catch (error) {
                    handleError(error);
                }
            });
        });

        // Error handling function with specific messages
        function handleError(error) {
            console.error('Xəta baş verdi:', error);

            let errorMessage = 'Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.';

            // Custom error messages based on error type
            if (error.message.includes('network')) {
                errorMessage = 'İnternet bağlantısı xətası. Bağlantınızı yoxlayın və yenidən cəhd edin.';
            } else if (error.message.includes('timeout')) {
                errorMessage = 'Sorğu vaxtı bitdi. Zəhmət olmasa yenidən cəhd edin.';
            } else if (error.message.includes('permission')) {
                errorMessage = 'İcazə xətası. Bu əməliyyatı yerinə yetirmək üçün lazımi icazələriniz yoxdur.';
            }

            Swal.fire({
                title: 'Xəta!',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'Bağla'
            });
        }
    });
</script>
