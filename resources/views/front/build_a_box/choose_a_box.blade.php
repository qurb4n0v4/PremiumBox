@extends('front.layouts.app')
@section('title', __('Build a Gift Box | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
@section('content')
    <div class="choose-box-line"></div>

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
                                                        data-box-name="{{ $boxDetail ? $boxDetail->box_name : $box->title }}"
                                                        data-box-price="{{ $box->price }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#customizeModal"
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

                        <!-- Add this modal markup just after the box details modal -->
                        <div class="modal fade" id="customizeModal" tabindex="-1" aria-labelledby="customizeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                <div class="modal-content rounded-4">
                                    <div class="modal-body p-4">
                                        <div class="d-flex flex-column">
                                            <div class="text-center mb-4">
                                                <h5 class="mb-3" style="color: #a3907a; font-size: 21px; font-weight: 600">Customize Your Box</h5>
                                                <p style="color: #898989; font-size: 14px">Personalize your gift box with custom items and messages.</p>
                                            </div>

                                            <!-- Selected Box Summary -->
                                            <div class="selected-box-summary mb-4 p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                                                <h6 style="color: #898989; font-size: 14px;">Selected Box</h6>
                                                <p class="selected-box-name mb-1" style="color: #a3907a; font-size: 16px; font-weight: 600"></p>
                                                <p class="selected-box-price mb-0" style="color: #212529; font-size: 16px;"></p>
                                            </div>

                                            <!-- Customize Options -->
                                            <div class="customize-options">
                                                <div class="mb-4">
                                                    <label class="form-label" style="color: #898989; font-size: 14px;">Gift Message (Optional)</label>
                                                    <textarea class="form-control" rows="3" placeholder="Enter your personal message..."></textarea>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label" style="color: #898989; font-size: 14px;">Special Instructions (Optional)</label>
                                                    <textarea class="form-control" rows="2" placeholder="Any special requests or instructions..."></textarea>
                                                </div>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="d-flex justify-content-between mt-3">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="padding: 10px 20px;">
                                                    Back
                                                </button>
                                                <button type="button" class="choose-box-customize-button" style="padding: 10px 30px;">
                                                    Continue to Items
                                                </button>
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
                const carousels = document.querySelectorAll('[data-bs-ride="carousel"]');
                carousels.forEach(carousel => new bootstrap.Carousel(carousel));

                const boxDetailsModals = document.querySelectorAll('[id^="boxDetailsModal_"]');
                boxDetailsModals.forEach(modal => {
                    modal.addEventListener('hidden.bs.modal');
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const customizeButtons = document.querySelectorAll('.choose-box-customize-button');
                const customizeModal = document.getElementById('customizeModal');

                customizeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Close the current box details modal
                        const boxDetailsModal = this.closest('.modal');
                        if (boxDetailsModal) {
                            const bsBoxDetailsModal = bootstrap.Modal.getInstance(boxDetailsModal);
                            bsBoxDetailsModal.hide();
                            // Remove any leftover backdrop from the box details modal
                            document.querySelector('.modal-backdrop').remove();
                        }

                        // Get box details from data attributes
                        const boxName = this.getAttribute('data-box-name');
                        const boxPrice = this.getAttribute('data-box-price');

                        // Update the customize modal with selected box details
                        const selectedBoxName = customizeModal.querySelector('.selected-box-name');
                        const selectedBoxPrice = customizeModal.querySelector('.selected-box-price');

                        if (selectedBoxName && selectedBoxPrice) {
                            selectedBoxName.textContent = boxName;
                            selectedBoxPrice.textContent = `₼ ${boxPrice}`;
                        }

                        // Show the customize modal
                        const bsCustomizeModal = new bootstrap.Modal(customizeModal);
                        bsCustomizeModal.show();
                    });
                });

                // Handle customize modal closing
                customizeModal.addEventListener('hidden.bs.modal', function () {
                    // Remove any remaining backdrop
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());

                    // Re-enable scrolling on the body
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                });
            });
        </script>

    @endpush


        <style>
        .customize-options textarea {
            border: 1px solid #ced4da;
            border-radius: 8px;
            resize: none;
        }

        .customize-options textarea:focus {
            border-color: #a3907a;
            box-shadow: 0 0 0 0.25rem rgba(163, 144, 122, 0.25);
        }

        .selected-box-summary {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }
    </style>

@endsection
