@extends('front.layouts.app')
@section('title', __('Build a Gift Box | BOX & TALE'))
    <link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
@section('content')
    <div class="choose-box-line"></div>

    <!-- Step titles -->
    <div class="choose-box-steps-container">
        @foreach (range(1, 4) as $stepNumber)
            <div class="choose-box-step">
                <div class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">{{ $stepNumber }}</div>
                <div class="choose-box-text">
                    <h3>{{ ['Choose Box', 'Choose Items', 'Choose Cards', 'Done'][$stepNumber - 1] }}</h3>
                    <p>{{ ['Pick your preferred box', 'Select the items to add', 'Pick a greeting card', 'Finalize your order'][$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Gift Boxes Section -->
    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Choose a Box</h3>
            <p style="font-size: 14px; color: #898989">Welcome to the most convenient way to create a unique and personalized gift box for your special loved ones.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Start by choosing the desired color of your gift box!</p>
        </div>
        <div class="row gy-4 mt-4">
            @php
                $nonEmptyCategories = $categories->filter(fn($category) => $category->boxes->isNotEmpty());
            @endphp

            @foreach($nonEmptyCategories as $categoryIndex => $category)
                <div class="category-name-boxsize">
                    <h4>{{ $category->name }}</h4>
                    <p>{{ $category->box_size }}</p>
                </div>

                <div class="row gy-4">
                    @foreach($category->boxes as $boxIndex => $box)
                        @php
                            $boxDetail = $box->details->first();
                            $uniqueModalId = "boxDetailsModal_{$categoryIndex}_{$boxIndex}";
                            $uniqueCarouselId = "boxCarousel_{$categoryIndex}_{$boxIndex}";
                        @endphp
                        <div class="col-md-6 col-lg-3">
                            <div class="card gift-box-card h-100">
                                <img src="{{ asset('storage/' . $box->image) }}" alt="{{ $box->title }}" loading="lazy">
                                <div class="gift-box-content">
                                    <h5 class="gift-box-title">{{ $box->company_name }}</h5>
                                    <h5 class="gift-box-name">{{ $box->title }}</h5>
                                    <p class="gift-box-price">₼ {{ $box->price }}</p>
                                    <button
                                        type="button"
                                        class="choose-box-choose-button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#{{ $uniqueModalId }}"
                                    >
                                        Choose Box
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Modal with Gift Box Details -->
                        <div class="modal fade" id="{{ $uniqueModalId }}" tabindex="-1" aria-labelledby="{{ $uniqueModalId }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                <div class="modal-content rounded-4">
                                    <div class="modal-body p-4">
                                        <div class="d-flex align-items-start gap-4">
                                            <!-- Image Carousel Section -->
                                            <div class="position-relative" style="width: 360px; flex-shrink: 0;">
                                                <div id="{{ $uniqueCarouselId }}" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @if($boxDetail && $boxDetail->images)
                                                            @foreach((is_string($boxDetail->images) ? json_decode($boxDetail->images) : $boxDetail->images) as $key => $imageUrl)
                                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                                    <div style="height: 340px; width: 360px; overflow: hidden;">
                                                                        <img src="{{ asset('storage/' . $imageUrl) }}"
                                                                             class="d-block w-100 h-100 object-fit-cover"
                                                                             alt="Box Image">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <!-- Navigation Buttons -->
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $uniqueCarouselId }}" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $uniqueCarouselId }}" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Enhanced Content Section with Details -->
                                            <div class="flex-grow-1">
                                                <div class="text-start">
                                                    <h6 class="mb-2" style="color: #898989; font-size: 14px;">{{ $box->company_name }}</h6>
                                                    <h5 class="mb-1" style="color: #a3907a; font-size: 21px; font-weight: 600">
                                                        {{ $boxDetail ? $boxDetail->box_name : $box->title }}
                                                    </h5>
                                                    @if($boxDetail && $boxDetail->available_same_day_delivery)
                                                        <div class="mb-3 bg-opacity-10 rounded">
                                                            <p class="m-0 text-success" style="color: #898989!important; font-style: italic; font-weight: 500; font-size: 12px">
                                                                Available for Same Day Delivery
                                                            </p>
                                                        </div>
                                                    @endif
                                                    <p class="mb-3" style="color: #212529; font-size: 20px !important; font-weight: 500">₼ {{ $box->price }}</p>

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

                                                    <button
                                                        type="button"
                                                        class="choose-box-customize-button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#customizeModal"
                                                        onclick="prepareCustomizationModal('{{ asset('storage/' . $box->image) }}', '{{ $box->id }}', '{{ $boxDetail ? $boxDetail->box_name : $box->title }}', '{{ $box->price }}')"
                                                    >
                                                        Customize
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- New Customization Modal -->
                        <div class="modal fade" id="customizeModal" tabindex="-1" aria-labelledby="customizeModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
                            <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                <div class="modal-content rounded-4">
                                    <div class="modal-body p-4">
                                        <div class="d-flex align-items-start gap-4">
                                            <!-- Image Section -->
                                            <div class="position-relative" style="width: 360px; flex-shrink: 0;">
                                                <img id="customizeModalImage" src="" class="d-block w-100 h-100 object-fit-cover" alt="Customization Image">
                                            </div>

                                            <!-- Content Section -->
                                            <div class="flex-grow-1">
                                                <div class="text-start">
                                                    <h6 id="customizeModalCompany" class="mb-2" style="color: #898989; font-size: 14px;"></h6>
                                                    <h5 id="customizeModalTitle" class="mb-1" style="color: #a3907a; font-size: 21px; font-weight: 600"></h5>
                                                    <p id="customizeModalPrice" class="mb-3" style="color: #212529; font-size: 20px !important; font-weight: 500"></p>

                                                    <!-- New Customization Inputs -->
                                                    <div class="mb-4">
                                                        <textarea class="form-control" rows="3" placeholder="Add a custom message"></textarea>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-outline-secondary me-2" data-font="Arial" onclick="applyFontFamily('Arial')">Arial</button>
                                                        <button class="btn btn-outline-secondary me-2" data-font="Courier New" onclick="applyFontFamily('Courier New')">Courier New</button>
                                                        <button class="btn btn-outline-secondary" data-font="Times New Roman" onclick="applyFontFamily('Times New Roman')">Times New Roman</button>
                                                    </div>

                                                    <!-- Submit Customization -->
                                                    <button class="btn btn-primary mt-4">Save Customization</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($categoryIndex < $nonEmptyCategories->count() - 1)
                    <div class="col-12">
                        <hr style="border-top: 1px solid #a3907a; margin: 20px 0;">
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize carousels
                const carousels = document.querySelectorAll('[data-bs-ride="carousel"]');
                carousels.forEach(carousel => new bootstrap.Carousel(carousel));

                // Initialize all box details modals
                const boxDetailsModals = document.querySelectorAll('[id^="boxDetailsModal_"]');
                boxDetailsModals.forEach(modal => {
                    modal.addEventListener('hidden.bs.modal', cleanupModal);
                });

                // Initialize customize modal
                const customizeModal = document.getElementById('customizeModal');
                if (customizeModal) {
                    customizeModal.addEventListener('hidden.bs.modal', cleanupModal);
                }

                function cleanupModal() {
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';

                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) backdrop.remove();

                    // Force body to be interactive
                    document.body.style.pointerEvents = '';
                    document.body.style.opacity = '';
                }
            });

            function prepareCustomizationModal(imageUrl, boxId, boxTitle, boxPrice) {
                // Close box details modal first
                const currentModal = document.querySelector('.modal.show[id^="boxDetailsModal_"]');
                if (currentModal) {
                    const bsModal = bootstrap.Modal.getInstance(currentModal);
                    if (bsModal) bsModal.hide();
                }

                // Set customization modal data
                const modal = document.getElementById('customizeModal');
                modal.querySelector('#customizeModalImage').src = imageUrl;
                modal.querySelector('#customizeModalCompany').textContent = `Box ID: ${boxId}`;
                modal.querySelector('#customizeModalTitle').textContent = boxTitle;
                modal.querySelector('#customizeModalPrice').textContent = `₼ ${boxPrice}`;

                // Reset any previous customizations
                const textarea = modal.querySelector('textarea');
                if (textarea) {
                    textarea.value = '';
                    textarea.style.fontFamily = '';
                }
            }

            function applyFontFamily(fontFamily) {
                const textarea = document.querySelector('#customizeModal textarea');
                if (textarea) textarea.style.fontFamily = fontFamily;
            }
        </script>

    @endpush

        <style>


        </style>

@endsection
