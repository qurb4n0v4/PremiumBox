@extends('front.layouts.app')
@section('title', __('Hədiyyə Qutusu Yaradın | | Premium Box'))
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}?v={{ time() }}">

    @php
        $hideFooter = true;
    @endphp

    <div class="choose-box-line"></div>

    <!-- Steps Progress Bar -->
    <div class="choose-box-steps-container">
        @foreach (range(1, 4) as $stepNumber)
            <div class="choose-box-step d-flex justify-content-center align-items-center">
                <a href="{{ route('choose.step', $stepNumber) }}"
                   style="text-decoration: none"
                   class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">
                    {{ $stepNumber }}
                </a>
                <div class="choose-box-text d-flex justify-content-center align-items-center">
                    <h3 id="choose-box-title">
                        {{ ['Qutu Seçin', 'Əşyaları Seçin', 'Kart Seçin', 'Tamamlandı'][$stepNumber - 1] }}
                    </h3>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Main Content Container -->
    <div class="container my-5 p-5 choose-boxes-page"
         style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%; margin-bottom: 90px!important;">

        <!-- Header Section -->
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Qutu Seçin</h3>
            <p style="font-size: 14px; color: #898989">Sevdikləriniz üçün unikal və şəxsi hədiyyə qutusu yaratmağın ən
                rahat yoluna xoş gəldiniz.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">İlk öncə istədiyiniz hədiyyə qutusunu
                seçin!</p>
        </div>

        <!-- Boxes Grid -->
        <div class="row gy-4 mt-4">
            @php
                $nonEmptyCategories = $categories->filter(fn($category) => $category->boxes->isNotEmpty());
            @endphp

            @foreach($nonEmptyCategories as $category)
                <div class="category-name-boxsize">
                    <h4>{{ $category->name }}</h4>
                    <p style="margin-bottom: 20px">{{ $category->width }}x{{ $category->height }}
                        x{{ $category->length }}</p>
                </div>

                <div class="row">
                    @foreach($category->boxes as $box)
                        @php
                            $boxDetail = $box->details->first();
                            $uniqueModalId1 = "modal1_" . $box->id;
                            $uniqueModalId2 = "modal2_" . $box->id;
                            $uniqueCarouselId = "boxCarousel_" . $box->id;
                        @endphp

                            <!-- Box Card -->
                        <div class="col-md-3"> <!-- 4 columns on medium and larger screens -->
                            <div class="gift-box-card">
                                <img src="{{ asset('storage/' . $box->image) }}"
                                     alt="{{ $box->title }}"
                                     loading="lazy">
                                <div class="gift-box-content">
                                    <h5 class="gift-box-title">{{ $box->company_name }}</h5>
                                    <h5 class="gift-box-name">{{ $box->title }}</h5>
                                    <p class="gift-box-price">₼ {{ $box->price }}</p>
                                    <button class="choose-box-choose-button"
                                            data-modal-target="{{ $uniqueModalId1 }}">
                                        Qutu Seç
                                    </button>
                                </div>
                            </div>
                        </div>


                        <!-- First Modal - Box Details -->
                        <div class="modal" id="{{ $uniqueModalId1 }}">
                            <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                <div class="modal-content rounded-4">
                                    <div class="modal-body p-4">
                                        <div class="d-flex align-items-start gap-4">
                                            <!-- Image Carousel -->
                                            <div class="position-relative" style="width: 360px; flex-shrink: 0;">
                                                <div id="{{ $uniqueCarouselId }}" class="carousel slide"
                                                     data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @if($boxDetail && $boxDetail->images)
                                                            @foreach((is_string($boxDetail->images) ? json_decode($boxDetail->images) : $boxDetail->images) as $key => $imageUrl)
                                                                <div
                                                                    class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                                    <div
                                                                        style="height: 340px; width: 360px; overflow: hidden;">
                                                                        <img src="{{ asset('storage/' . $imageUrl) }}"
                                                                             class="d-block w-100 h-100 object-fit-cover"
                                                                             alt="Box Image">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <button class="carousel-control-prev" type="button"
                                                            data-bs-target="#{{ $uniqueCarouselId }}"
                                                            data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"
                                                              style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Əvvəlki</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button"
                                                            data-bs-target="#{{ $uniqueCarouselId }}"
                                                            data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"
                                                              style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Sonrakı</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Box Details -->
                                            <div class="flex-grow-1">
                                                <div class="text-start">
                                                    <h6 class="mb-2"
                                                        style="color: #898989; font-size: 14px;">{{ $box->company_name }}</h6>
                                                    <h5 class="mb-1"
                                                        style="color: #a3907a; font-size: 21px; font-weight: 600">
                                                        {{ $boxDetail ? $boxDetail->box_name : $box->title }}
                                                    </h5>
                                                    @if($boxDetail && $boxDetail->available_same_day_delivery)
                                                        <div class="mb-3 bg-opacity-10 rounded">
                                                            <p class="m-0 text-success"
                                                               style="color: #898989!important; font-style: italic; font-weight: 500; font-size: 12px">
                                                                Eyni Gün Çatdırılma Mövcuddur
                                                            </p>
                                                        </div>
                                                    @endif
                                                    <p class="mb-3"
                                                       style="color: #212529; font-size: 20px !important; font-weight: 500">
                                                        ₼ {{ $box->price }}</p>

                                                    <div class="mb-4" style="height: 90px; overflow-y: auto;">
                                                        @if($boxDetail && $boxDetail->paragraph)
                                                            <p style="color: #898989; line-height: 1.6; font-size: 12px">{{ $boxDetail->paragraph }}</p>
                                                        @endif

                                                        @if($boxDetail && $boxDetail->additional)
                                                            <div class="mt-3">
                                                                <p style="color: #898989; font-size: 12px">{{ $boxDetail->additional }}</p>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <button type="button"
                                                            class="choose-box-customize-button"
                                                            data-modal-target="{{ $uniqueModalId2 }}"
                                                            data-modal-close="{{ $uniqueModalId1 }}">
                                                        Fərdiləşdir
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Second Modal - Customization -->
                        <div class="modal" id="{{ $uniqueModalId2 }}">
                            <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                <div class="modal-content rounded-4">
                                    <div class="modal-body p-4 h-100">
                                        <div class="d-flex align-items-start gap-4 h-100">
                                            <!-- Customization Preview -->
                                            <div
                                                class="position-relative d-flex align-items-center justify-content-center"
                                                style="width: 360px; flex-shrink: 0;">
                                                <div class="d-flex align-items-center justify-content-center"
                                                     style="height: 260px; width: 260px; overflow: hidden;">
                                                    @if($boxDetail && $boxDetail->customize_image)
                                                        <img src="{{ asset('storage/' . $boxDetail->customize_image) }}"
                                                             class="d-block w-100 h-100 object-fit-cover"
                                                             alt="Customize Image">
                                                    @endif
                                                    <div id="textOverlay_{{ $box->id }}"
                                                         class="position-absolute"
                                                         style="top: 50%; left: 50%; transform: translate(-50%, -50%);
                                                                text-align: center; color: white; font-size: 24px;
                                                                font-weight: bold; pointer-events: none; width: 80%;
                                                                word-wrap: break-word; z-index: 1000;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Customization Options -->
                                            <div class="flex-grow-1">
                                                <div class="text-start">
                                                    <h6 class="mb-2"
                                                        style="color: #898989; font-size: 14px;">{{ $box->company_name }}</h6>
                                                    <h5 class="mb-1"
                                                        style="color: #a3907a; font-size: 21px; font-weight: 600">
                                                        {{ $boxDetail ? $boxDetail->box_name : $box->title }}
                                                    </h5>
                                                    @if($boxDetail && $boxDetail->available_same_day_delivery)
                                                        <div class="mb-3 bg-opacity-10 rounded">
                                                            <p class="m-0 text-success"
                                                               style="color: #898989!important; font-style: italic; font-weight: 500; font-size: 12px">
                                                                Eyni Gün Çatdırılma Mövcuddur
                                                            </p>
                                                        </div>
                                                    @endif
                                                    <p class="mb-3"
                                                       style="color: #212529; font-size: 20px !important; font-weight: 500">
                                                        ₼ {{ $box->price }}</p>

                                                    <div>
                                                        <p class="customizing-text-style-font"
                                                           style="margin-top: 20px; color: #a3907a">Ad və ya Yazı ilə
                                                            Şəxsi Fərdiləşdirmə</p>
                                                        <textarea
                                                            class="customizing-text-input-fonts box-customize-text"
                                                            data-box-id="{{ $box->id }}"
                                                            required></textarea>
                                                        <p class="customizing-text-style-font"
                                                           style="margin-top: 10px; color: #a3907a">Yazı stilini
                                                            seçin</p>
                                                        <div class="button-group-customizing-fonts"
                                                             data-box-id="{{ $box->id }}">
                                                            <button class="font-button-customizing-edit"
                                                                    data-font="Playwrite AU SA"
                                                                    style="font-family: Playwrite AU SA">Font A
                                                            </button>
                                                            <button class="font-button-customizing-edit"
                                                                    data-font="Josefin Sans"
                                                                    style="font-family: Josefin Sans;">Font B
                                                            </button>
                                                            <button class="font-button-customizing-edit"
                                                                    data-font="Indie Flower"
                                                                    style="font-family: Indie Flower;">Font C
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <button class="choose-box-customize-button submit-customize"
                                                            style="text-decoration: none"
                                                            data-box-id="{{ $box->id }}">
                                                        Tamamla
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(!$loop->last)
                    <div class="col-12">
                        <hr style="border-top: 1px solid #a3907a; margin: 20px 0;">
                    </div>
                @endif
            @endforeach
        </div>

        @include('front.build_a_box.selected-items-summary')
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Carousel initialization
        const carousels = document.querySelectorAll('[data-bs-ride="carousel"]');
        carousels.forEach(carousel => new bootstrap.Carousel(carousel));

        // Modal handling
        document.addEventListener('click', function (event) {
            // Open modal
            if (event.target.hasAttribute('data-modal-target')) {
                const modalId = event.target.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'flex';
                    document.documentElement.classList.add('modal-opened');
                    document.body.classList.add('modal-opened');
                }
            }

            // Close modal when clicking previous modal button
            if (event.target.hasAttribute('data-modal-close')) {
                const modalId = event.target.getAttribute('data-modal-close');
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'none';
                }
            }

            // Close modal when clicking outside
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
                document.documentElement.classList.remove('modal-opened');
                document.body.classList.remove('modal-opened');
            }
        });

        // Text overlay handling
        document.querySelectorAll('.box-customize-text').forEach(textarea => {
            const boxId = textarea.getAttribute('data-box-id');
            const textOverlay = document.querySelector(`#textOverlay_${boxId}`);

            if (textarea && textOverlay) {
                // Update text overlay when typing
                textarea.addEventListener('input', function () {
                    textOverlay.textContent = this.value;
                    // Remove invalid state if text is entered
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });

                // Font selection handling
                const buttonGroup = document.querySelector(`.button-group-customizing-fonts[data-box-id="${boxId}"]`);
                if (buttonGroup) {
                    const fontButtons = buttonGroup.querySelectorAll('.font-button-customizing-edit');

                    fontButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            // Remove active class from all buttons in this group
                            fontButtons.forEach(btn => {
                                btn.classList.remove('active', 'selected');
                                btn.style.borderColor = '';
                            });
                            // Add active class to clicked button
                            this.classList.add('active', 'selected');
                            // Apply selected font to overlay text
                            textOverlay.style.fontFamily = this.getAttribute('data-font');
                        });
                    });
                }
            }
        });

        // Step navigation
        document.querySelectorAll('.choose-box-circle').forEach(circle => {
            circle.addEventListener('click', function (e) {
                const step = this.textContent.trim();
                window.location.href = `/choose-step/${step}`;
            });
        });

        // Updated submit customization handling
        document.querySelectorAll('.submit-customize').forEach(submitButton => {
            submitButton.addEventListener('click', async function (e) {
                e.preventDefault();

                // Get elements
                const boxId = this.getAttribute('data-box-id');
                const boxElement = document.querySelector(`[data-box-id="${boxId}"]`);
                const textarea = document.querySelector(`.box-customize-text[data-box-id="${boxId}"]`);
                const fontButtons = document.querySelectorAll(`.button-group-customizing-fonts[data-box-id="${boxId}"] .font-button-customizing-edit`);

                // Validate form
                if (!validateForm(textarea, fontButtons)) {
                    return;
                }

                // Get selected font
                const selectedFont = getSelectedFont(fontButtons);

                try {
                    // Save to session
                    const response = await saveToSession({
                        gift_box_id: boxId,
                        box_name: boxElement.getAttribute('data-box-name'),
                        box_image: boxElement.getAttribute('data-box-image'),
                        box_price: boxElement.getAttribute('data-box-price'),
                        box_customization_text: textarea.value.trim(),
                        selected_font: selectedFont
                    });

                    if (response.success) {
                        // Get current step and redirect to next step
                        const stepResponse = await getCurrentStep();
                        if (stepResponse.success) {
                            window.location.href = '{{ route('choose.items') }}';
                        }
                    } else {
                        handleError(response.message);
                    }
                } catch (error) {
                    handleError(error);
                }
            });
        });

// Form validation
        function validateForm(textarea, fontButtons) {
            let isValid = true;

            // Validate text
            if (!textarea.value.trim()) {
                textarea.classList.add('is-invalid');
                isValid = false;
            } else {
                textarea.classList.remove('is-invalid');
            }

            // Validate font selection
            const hasSelectedFont = Array.from(fontButtons).some(button =>
                button.classList.contains('selected')
            );

            fontButtons.forEach(button => {
                if (!hasSelectedFont) {
                    button.style.borderColor = '#dc3545';
                    isValid = false;
                } else {
                    button.style.borderColor = '';
                }
            });

            return isValid;
        }

// Get selected font
        function getSelectedFont(fontButtons) {
            const selectedButton = Array.from(fontButtons).find(button =>
                button.classList.contains('selected')
            );
            return selectedButton ? selectedButton.getAttribute('data-font') : null;
        }

// Save to session
        async function saveToSession(data) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch('/session/save-box', {
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

// Get current step
        async function getCurrentStep() {
            const response = await fetch('/session/current-step', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            return await response.json();
        }

// Handle errors
        function handleError(error) {
            console.error('Request Error:', error);
            showError('Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.');
        }

// Show error message
        function showError(message) {
            alert(message);
        }

        // Add CSS for invalid state
        const style = document.createElement('style');
        style.textContent = `
        .customizing-text-input-fonts.is-invalid {
            border-color: #dc3545 !important;
            background-image: none !important;
        }
        .customizing-text-input-fonts.is-invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
    `;
        document.head.appendChild(style);

        //h3 choose-box-title
        function updateChooseBoxTitles() {
            const titles = ["Qutu Seçin", "Əşyaları Seçin", "Kart Seçin", "Tamamlandı"];
            const shortTitles = ["Qutu", "Əşyalar", "Kart", "Tamamlandı"];

            const chooseBoxTitles = document.querySelectorAll("#choose-box-title");

            chooseBoxTitles.forEach((title, index) => {
                if (window.innerWidth <= 768) {
                    title.textContent = shortTitles[index];
                } else {
                    title.textContent = titles[index];
                }
            });
        }

        updateChooseBoxTitles();
        window.addEventListener("resize", updateChooseBoxTitles);
    });
</script>

