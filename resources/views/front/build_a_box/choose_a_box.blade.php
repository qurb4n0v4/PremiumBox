@extends('front.layouts.app')
@section('title', __('Build a Gift Box | BOX & TALE'))
@section('content')
    <!-- Horizontal Line -->
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

            @foreach($nonEmptyCategories as $index => $category)
                <div class="col-12 mb-3">
                    <div class="category-name-boxsize">
                        <h4 style="position: relative; margin-right: 15px;">{{ $category->name }}</h4>
                        <p style="color: #898989; font-size: 13px; margin-top: 0;">{{ $category->box_size }}</p>
                    </div>
                </div>

                <div class="row">
                    @foreach($category->boxes as $boxIndex => $box)
                        @php
                            $boxDetail = $box->details->first();
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
                                        data-bs-target="#boxDetailsModal{{ $boxIndex }}"
                                    >
                                        Choose Box
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Modal with Gift Box Details -->
                        <div class="modal fade" id="boxDetailsModal{{ $boxIndex }}" tabindex="-1" aria-labelledby="boxDetailsModalLabel{{ $boxIndex }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                <div class="modal-content rounded-4">
                                    <div class="modal-body p-4">
                                        <div class="d-flex align-items-start gap-4">
                                            <!-- Image Carousel Section -->
                                            <div class="position-relative" style="width: 360px; flex-shrink: 0;">
                                                <div id="boxCarousel{{ $boxIndex }}" class="carousel slide" data-bs-ride="carousel">
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
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#boxCarousel{{ $boxIndex }}" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#boxCarousel{{ $boxIndex }}" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Enhanced Content Section with Details -->
                                            <div class="flex-grow-1">
                                                <div class="text-start">
                                                    <h6 class="mb-2" style="color: #898989; font-size: 16px;">{{ $box->company_name }}</h6>
                                                    <h5 class="mb-1" style="color: #a3907a; font-size: 24px;">
                                                        {{ $boxDetail ? $boxDetail->box_name : $box->title }}
                                                    </h5>
                                                    @if($boxDetail && $boxDetail->available_same_day_delivery)
                                                        <div class="mb-3 bg-opacity-10 rounded">
                                                            <p class="m-0 text-success" style="color: #898989!important; font-style: italic; font-weight: 500">
                                                                Available for Same Day Delivery
                                                            </p>
                                                        </div>
                                                    @endif
                                                    <p class="mb-3" style="color: #212529; font-size: 18px !important; font-weight: 500">₼ {{ $box->price }}</p>


                                                    <div class="mb-4" style="height: 200px; overflow-y: auto;">
                                                        @if($boxDetail && $boxDetail->paragraph)
                                                            <p style="color: #898989; line-height: 1.6;">{{ $boxDetail->paragraph }}</p>
                                                        @endif

                                                        @if($boxDetail && $boxDetail->additional)
                                                            <div class="mt-3">
                                                                <p style="color: #898989">{{ $boxDetail->additional }}</p>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <button
                                                        type="button"
                                                        class="choose-box-choose-button"
                                                        onclick="selectBox('{{ $box->id }}', '{{ $boxDetail ? $boxDetail->box_name : $box->title }}', '{{ $box->price }}')"
                                                        style="width: 100%; padding: 12px;"
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
                    @endforeach
                </div>

                @if($index < $nonEmptyCategories->count() - 1)
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
                const twoupCarousels = document.querySelectorAll('.two-up-carousel');
                twoupCarousels.forEach(carousel => {
                    new bootstrap.Carousel(carousel, {
                        interval: 2000,
                        ride: 'carousel'
                    });
                });
            });

            function selectBox(boxId, boxTitle, boxPrice) {
                console.log(`Selected Box: ID=${boxId}, Title=${boxTitle}, Price=${boxPrice}`);

                window.location.href = `/next-step?box_id=${boxId}`;
            }
        </script>
    @endpush

        <style>
            .text-center, h3, h4, h5, h6, p, .gift-box-title, .gift-box-name, .gift-box-price {
                text-align: center !important;
            }

            .choose-box-choose-button {
                padding: 10px !important;
                font-size: 14px !important;
            }

            .modal-content {
                border: none;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }

            .carousel-control-prev,
            .carousel-control-next {
                width: auto;
                padding: 0 10px;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                width: 25px;
                height: 25px;
                background-size: 100%;
                filter: invert(1) grayscale(100);
            }

            .carousel-control-prev:hover,
            .carousel-control-next:hover {
                opacity: 0.8;
            }

        </style>

@endsection
