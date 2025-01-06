@extends('front.layouts.app')
@section('title', __('Hədiyyə Qutusu Yaradın | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
@section('content')
    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
        @foreach (range(1, 4) as $stepNumber)
            <div class="choose-box-step">
                <div class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">{{ $stepNumber }}</div>
                <div class="choose-box-text">
                    <h3>{{ ['Qutu Seçin', 'Əşyaları Seçin', 'Kart Seçin', 'Tamamlandı'][$stepNumber - 1] }}</h3>
                    <p>{{ ['Seçdiyiniz qutunu seçin', 'Əşyaları əlavə edin', 'Təbrik kartını seçin', 'Sifarişi tamamlayın'][$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Qutu Seçin</h3>
            <p style="font-size: 14px; color: #898989">Sevdikləriniz üçün unikal və şəxsi hədiyyə qutusu yaratmağın ən rahat yoluna xoş gəldiniz.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">İlk öncə istədiyiniz hədiyyə qutusunun rəngini seçin!</p>
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
                            $uniqueCarouselId = "boxCarousel_{$categoryIndex}_{$boxIndex}";
                            $uniqueModalId1 = "modal1_{$categoryIndex}_{$boxIndex}";
                            $uniqueModalId2 = "modal2_{$categoryIndex}_{$boxIndex}";
                        @endphp
                        <div class="col-md-6 col-lg-3">
                            <div class="card gift-box-card h-100">
                                <img src="{{ asset('storage/' . $box->image) }}" alt="{{ $box->title }}" loading="lazy">
                                <div class="gift-box-content">
                                    <h5 class="gift-box-title">{{ $box->company_name }}</h5>
                                    <h5 class="gift-box-name">{{ $box->title }}</h5>
                                    <p class="gift-box-price">₼ {{ $box->price }}</p>
                                    <button
                                        class="choose-box-choose-button"
                                        data-modal-target="{{ $uniqueModalId1 }}"
                                    >
                                        Qutunu Seç
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="{{ $uniqueModalId1 }}">
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
                                                        <span class="visually-hidden">Əvvəlki</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $uniqueCarouselId }}" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Sonrakı</span>
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
                                                                Eyni Gün Çatdırılma Mövcuddur
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
                                                        data-modal-target="{{ $uniqueModalId2 }}"
                                                        data-modal-close="{{ $uniqueModalId1 }}"
                                                    >
                                                        Tənzimləmək
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="{{ $uniqueModalId2 }}">
                            <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                <div class="modal-content rounded-4">

                                    <div class="modal-body p-4">
                                        <div class="d-flex align-items-start gap-4">
                                            <!-- Image Carousel Section -->
                                            <div class="position-relative" style="width: 360px; flex-shrink: 0;">

                                                <div style="height: 340px; width: 360px; overflow: hidden;">
                                                    @if($boxDetail && $boxDetail->images)
                                                        @php
                                                            $images = is_string($boxDetail->images) ? json_decode($boxDetail->images) : $boxDetail->images;
                                                            $firstImage = !empty($images) ? $images[0] : null;
                                                        @endphp

                                                        @if($firstImage)
                                                            <img src="{{ asset('storage/' . $firstImage) }}"
                                                                 class="d-block w-100 h-100 object-fit-cover"
                                                                 alt="Box Image">
                                                        @endif
                                                    @endif
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
                                                                Eyni Gün Çatdırılma Mövcuddur
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
                                                    >
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

                @if($categoryIndex < $nonEmptyCategories->count() - 1)
                    <div class="col-12">
                        <hr style="border-top: 1px solid #a3907a; margin: 20px 0;">
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize carousels
        const carousels = document.querySelectorAll('[data-bs-ride="carousel"]');
        carousels.forEach(carousel => new bootstrap.Carousel(carousel));

        // Modal handling
        document.addEventListener('click', function(event) {
            // Open modal
            if (event.target.hasAttribute('data-modal-target')) {
                const modalId = event.target.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'flex';
                }
            }

            // Close modal
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
            }
        });
    });
</script>
