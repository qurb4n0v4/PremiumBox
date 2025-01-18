@extends('front.layouts.app')
@section('title', __('Hədiyyə Qutusu Yaradın | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-items.css') }}">
@section('content')
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
                <div class="choose-box-text">
                    <h3>{{ ['Qutu Seçin', 'Əşyaları Seçin', 'Kart Seçin', 'Tamamlandı'][$stepNumber - 1] }}</h3>
                    <p>{{ ['Seçdiyiniz qutunu seçin', 'Əşyaları əlavə edin', 'Təbrik kartını seçin', 'Sifarişi tamamlayın'][$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Məhsulları seçin</h3>
            <p style="font-size: 14px; color: #898989">Sizin üçün ən yaxşı məhsulları seçdik.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Aşağıdakı məhsulları seçin, qutunu doldurun və özəlləşdirin!</p>
        </div>

        <hr style="color: #898989">

        <div class="gy-4 mt-4" style="margin-top: 30px!important;">

            <div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="filters">
                            <h5>Məhsulları Filtrləyin</h5>
                            <!-- Alıcı Filtresi -->
                            <div class="filter-section">
                                <label for="recipient">Alıcı</label>
                                <select id="recipient" class="form-control">
                                    <option value="all">Hamısı</option>
                                    <option value="male">Kişi</option>
                                    <option value="female">Qadın</option>
                                    <option value="children">Uşaq</option>
                                </select>
                            </div>
                            <!-- Xüsusi Günlər -->
                            <div class="filter-section">
                                <label for="occasions">Xüsusi Günlər</label>
                                <select id="occasions" class="form-control">
                                    <option value="all">Hamısı</option>
                                    <option value="birthday">Ad günü</option>
                                    <option value="wedding">Toy</option>
                                    <option value="anniversary">İl dönümü</option>
                                </select>
                            </div>
                            <!-- Qiymət Aralığı -->
                            <div class="filter-section">
                                <label for="price-range">Qiymət Aralığı</label>
                                <input type="range" id="price-range" class="form-control" min="0" max="1000" step="10">
                                <span id="price-range-label">₼ 0 - ₼ 1000</span>
                            </div>
                            <!-- İstehsal Müddəti -->
                            <div class="filter-section">
                                <label for="production-time">İstehsal Müddəti</label>
                                <select id="production-time" class="form-control">
                                    <option value="all">Hamısı</option>
                                    <option value="1">1 gün</option>
                                    <option value="3">3 gün</option>
                                    <option value="7">7 gün</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-9">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="search-container">
                                <input type="text" id="search-box" class="form-control" placeholder="Qutuları axtarın...">
                            </div>
                            <div class="sort-container">
                                <select id="sort-boxes" class="form-control">
                                    <option value="default">Sırala: Varsayılan</option>
                                    <option value="price_asc">Qiymət: Artan</option>
                                    <option value="price_desc">Qiymət: Azalan</option>
                                    <option value="name_asc">Ad: A-dan Z-yə</option>
                                    <option value="name_desc">Ad: Z-dən A-ya</option>
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            @foreach ($chooseItems as $item)
                                <div class="col-md-4 mb-4">
                                    <div class="card text-center border-0" data-item-id="{{ $item->id }}">
                                        <div class="image-wrapper" style="position: relative;">
                                            <img
                                                src="{{ asset('storage/' . $item->normal_image) }}"
                                                alt="{{ $item->name }}"
                                                class="img-fluid normal-image"
                                            >
                                            @if($item->hover_image)
                                                <img
                                                    src="{{ asset('storage/' . $item->hover_image) }}"
                                                    alt="{{ $item->name }}"
                                                    class="img-fluid hover-image"
                                                >
                                            @endif
                                        </div>

                                        <h5 class="mt-3">{{ $item->company_name }}</h5>

                                        <p style="margin-top: -5px">{{ $item->name }}</p>

                                        <p class="text-muted" style="margin-top: -13px; color: #343a40!important;">₼{{ number_format($item->price, 2) }}</p>

                                        <!-- Button -->
                                        @if($item->button == 'Custom Product')
                                            <button class="choose-items-button"
                                                    type="button"
                                                    data-bs-target="#productPreviewModal_{{ $item->id }}">
                                                {{ $item->button }}
                                            </button>
                                        @else
                                            <button class="choose-items-button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-{{ $item->id }}">
                                                {{ $item->button }}
                                            </button>
                                        @endif
                                    </div>
                                </div>


                                <!-- Modals -->
                                @if($item->button == 'Custom Product')
                                    <!-- First Modal - Product Preview -->
                                    <div class="modal fade" id="productPreviewModal_{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-body p-4">
                                                    <div class="d-flex align-items-start gap-4">
                                                        <!-- Image Carousel Section -->
                                                        <div class="position-relative" style="width: 360px; flex-shrink: 0;">
                                                            <div id="previewCarousel_{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @if($item->customProductDetails)
                                                                        @foreach($item->customProductDetails->images as $index => $image)
                                                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" style="height: 340px; width: 360px; overflow: hidden;">                                                                                <img src="{{ asset('storage/' . $image) }}"
                                                                                     class="d-block w-100 h-100 object-fit-cover" style="object-fit: cover"
                                                                                     alt="Product Image {{ $index + 1 }}">
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>

                                                                <button class="carousel-control-prev" type="button"
                                                                        data-bs-target="#previewCarousel_{{ $item->id }}" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                                    <span class="visually-hidden">Əvvəlki</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button"
                                                                        data-bs-target="#previewCarousel_{{ $item->id }}" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                                    <span class="visually-hidden">Sonrakı</span>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <div class="text-start">
                                                                <p class="mb-1" style="color: #898989; font-size: 14px;">{{ $item->company_name }}</p>
                                                                <p class="mb-2" style="color: #a3907a; font-size: 21px; font-weight: 600">{{ $item->name }}</p>

                                                                @if($item->customProductDetails && $item->customProductDetails->same_day_delivery)
                                                                    <div class="mb-3 delivery-info">
                                                                        <p class="m-0">Eyni Gün Çatdırılma Mövcuddur</p>
                                                                    </div>
                                                                @endif

                                                                <p class="mb-3" style="color: #212529; font-size: 20px !important; font-weight: 500">
                                                                    ₼{{ number_format($item->price, 2) }}
                                                                </p>

                                                                @if($item->customProductDetails && $item->customProductDetails->description)
                                                                    <div class="variant-paragraph" id="preview-description-{{ $item->id }}" data-full-text="{{ $item->customProductDetails->description }}">
                                                                        <p class="content">{{ \Illuminate\Support\Str::limit($item->customProductDetails->description, 200, ' ...') }}</p>
                                                                        <span class="show-more-btn" onclick="toggleText('preview-description-{{ $item->id }}')">Show more</span>
                                                                    </div>
                                                                @endif

                                                                <button type="button"
                                                                        class="choose-box-customize-button mt-3"
                                                                        onclick="openCustomizationModal('{{ $item->id }}')">
                                                                    Tənzimləmək
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Second Modal - Customization -->
                                    <div class="modal fade" id="customizationModal_{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-body p-4 h-100">
                                                    <div class="d-flex align-items-start gap-4 h-100">
                                                        <div class="position-relative" style="width: 360px; flex-shrink: 0;">
                                                            <div id="previewCarousel_{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @if($item->customProductDetails)
                                                                        @foreach($item->customProductDetails->images as $index => $image)
                                                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" style="height: 340px; width: 360px; overflow: hidden;">
                                                                                <img src="{{ asset('storage/' . $image) }}"
                                                                                     class="d-block w-100 h-100 object-fit-cover" style="object-fit: cover"
                                                                                     alt="Product Image {{ $index + 1 }}">
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>

                                                                <button class="carousel-control-prev" type="button"
                                                                        data-bs-target="#previewCarousel_{{ $item->id }}" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                                    <span class="visually-hidden">Əvvəlki</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button"
                                                                        data-bs-target="#previewCarousel_{{ $item->id }}" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                                    <span class="visually-hidden">Sonrakı</span>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <div class="text-start">
                                                                <p class="mb-1" style="color: #898989; font-size: 14px;">{{ $item->company_name }}</p>
                                                                <p class="mb-2" style="color: #a3907a; font-size: 21px; font-weight: 600">{{ $item->name }}</p>

                                                                @if($item->customProductDetails && $item->customProductDetails->same_day_delivery)
                                                                    <div class="mb-3 delivery-info">
                                                                        <p class="m-0">Eyni Gün Çatdırılma Mövcuddur</p>
                                                                    </div>
                                                                @endif

                                                                <p class="mb-3" style="color: #212529; font-size: 20px !important; font-weight: 500">
                                                                    ₼{{ number_format($item->price, 2) }}
                                                                </p>

                                                                @if($item->customProductDetails && $item->customProductDetails->description)
                                                                    <div class="variant-paragraph" id="customization-description-{{ $item->id }}" data-full-text="{{ $item->customProductDetails->description }}">
                                                                        <p class="content">{{ \Illuminate\Support\Str::limit($item->customProductDetails->description, 200, ' ...') }}</p>
                                                                        <span class="show-more-btn" onclick="toggleText('customization-description-{{ $item->id }}')">Show more</span>
                                                                    </div>
                                                                @endif

                                                                {{-- Add variants section --}}
                                                                @if($item->customProductDetails && $item->customProductDetails->has_variants)
                                                                    @if($item->customProductDetails->variant_selection_title)
                                                                        <h6 class="mt-3 variant-title">{{ $item->customProductDetails->variant_selection_title }}</h6>
                                                                    @endif

                                                                    @php
                                                                        $variantData = is_string($item->customProductDetails->variants)
                                                                            ? json_decode($item->customProductDetails->variants, true)
                                                                            : $item->customProductDetails->variants;
                                                                    @endphp

                                                                    <div class="variants-buttons d-flex flex-wrap justify-content-center mt-2">
                                                                        @if(is_array($variantData))
                                                                            @foreach($variantData as $index => $variant)
                                                                                <button
                                                                                    class="btn btn-outline-secondary m-1 variant-button {{ $index === 0 ? 'active' : '' }}"
                                                                                    data-price="{{ $variant['price'] ?? $item->price }}"
                                                                                >
                                                                                    {{ $variant['name'] ?? 'Unnamed Variant' }}
                                                                                </button>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                @endif

                                                                {{-- Add image upload section if allowed --}}
                                                                @if($item->customProductDetails && $item->customProductDetails->allow_user_images)
                                                                    <div class="mt-3">
                                                                        <h6 style="font-size: 14px; color: #a39079">{{ $item->customProductDetails->image_upload_title }}</h6>
                                                                        <div class="upload-wrapper">
                                                                            <div class="upload-container" id="uploadContainer_{{ $item->id }}">
                                                                                @for($i = 0; $i < $item->customProductDetails->max_image_count; $i++)
                                                                                    <label class="custom-upload-box">
                                                                                        <input type="file" class="hidden-input" accept="image/*"
                                                                                               onchange="handleImageUpload(this, {{ $item->id }}, {{ $i }})">
                                                                                        <div class="upload-icon">+</div>
                                                                                        <img class="image-preview" src="" alt="">
                                                                                    </label>
                                                                                @endfor
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <style>
                                                                        .upload-wrapper {
                                                                            display: flex;
                                                                            justify-content: center;
                                                                            width: 100%;
                                                                        }

                                                                        .upload-container {
                                                                            display: flex;
                                                                            gap: 10px;
                                                                            flex-wrap: wrap;
                                                                            justify-content: center;
                                                                        }

                                                                        .custom-upload-box {
                                                                            display: flex;
                                                                            align-items: center;
                                                                            justify-content: center;
                                                                            width: 60px;
                                                                            height: 60px;
                                                                            border: 2px solid #9da4aa;
                                                                            border-radius: 12px;
                                                                            cursor: pointer;
                                                                            transition: all 0.3s ease;
                                                                            position: relative;
                                                                            overflow: hidden;
                                                                        }

                                                                        .hidden-input {
                                                                            display: none;
                                                                        }

                                                                        .upload-icon {
                                                                            font-size: 40px;
                                                                            color: #6C757D;
                                                                            font-weight: 300;
                                                                            position: absolute;
                                                                        }
                                                                    </style>

                                                                    <script>
                                                                        function handleImageUpload(input, itemId, index) {
                                                                            if (input.files && input.files[0]) {
                                                                                const container = input.closest('.custom-upload-box');
                                                                                const uploadIcon = container.querySelector('.upload-icon');
                                                                                const imagePreview = container.querySelector('.image-preview');
                                                                                const reader = new FileReader();

                                                                                reader.onload = function(e) {
                                                                                    imagePreview.src = e.target.result;
                                                                                    imagePreview.style.display = 'block';
                                                                                    uploadIcon.style.display = 'none';
                                                                                }

                                                                                reader.readAsDataURL(input.files[0]);

                                                                                // Store the uploaded file in FormData for later submission
                                                                                if (!window.uploadedFiles) {
                                                                                    window.uploadedFiles = {};
                                                                                }
                                                                                if (!window.uploadedFiles[itemId]) {
                                                                                    window.uploadedFiles[itemId] = {};
                                                                                }
                                                                                window.uploadedFiles[itemId][index] = input.files[0];
                                                                            }
                                                                        }

                                                                        // Function to get all uploaded files for an item
                                                                        function getUploadedFiles(itemId) {
                                                                            return window.uploadedFiles && window.uploadedFiles[itemId]
                                                                                ? Object.values(window.uploadedFiles[itemId])
                                                                                : [];
                                                                        }
                                                                    </script>
                                                                @endif
                                                                {{-- Add textarea section --}}
                                                                @if($item->customProductDetails && $item->customProductDetails->has_custom_text)
                                                                    <div class="mt-5">
        <textarea
            style="height: 40px; outline: none;"
            class="form-control custom-text"
            placeholder="{{ $item->customProductDetails->text_field_placeholder }}"
            rows="3"
        ></textarea>
                                                                    </div>
                                                                @endif


                                                                <button class="choose-box-choose-button mt-1">Qutuya əlavə et</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.querySelectorAll('.variant-button').forEach(button => {
                                            button.addEventListener('click', function() {
                                                const parentDiv = this.closest('.variants-buttons');
                                                parentDiv.querySelectorAll('.variant-button').forEach(btn => btn.classList.remove('active'));
                                                this.classList.add('active');

                                                const modalBody = this.closest('.modal-body');
                                                const imageElement = modalBody.querySelector('.variant-image');
                                                imageElement.src = this.dataset.image;

                                                const priceElement = modalBody.querySelector('.variant-price');
                                                priceElement.textContent = Number(this.dataset.price).toFixed(2);
                                            });
                                        });
                                    </script>

                                @elseif($item->button == 'Choose Variant')
                                    <div class="modal fade" id="modal-{{ $item->id }}" tabindex="-1" aria-labelledby="chooseVariantModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 60%;">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-body d-flex justify-content-between">
                                                    <!-- Left Section: Single Image Display -->
                                                    <div class="col-md-6 variant-image-section">
                                                        <div class="variant-image-container w-100 h-100">
                                                            @if($item->chooseVariants->isNotEmpty())
                                                                @foreach($item->chooseVariants as $chooseVariant)
                                                                    @php
                                                                        $variantData = is_string($chooseVariant->variants)
                                                                            ? json_decode($chooseVariant->variants, true)
                                                                            : $chooseVariant->variants;
                                                                    @endphp

                                                                    @if(is_array($variantData) && !empty($variantData))
                                                                        <img
                                                                            src="{{ asset('storage/' . $variantData[0]['image']) }}"
                                                                            class="d-block w-100 h-100 variant-image"
                                                                            style="object-fit: cover;"
                                                                            data-variant-id="{{ $chooseVariant->id }}"
                                                                        >
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Right Section: Data -->
                                                    <div class="col-md-6 variant-info-section">
                                                        <div class="variant-info-content">
                                                            <p class="mb-1 company-name">{{ $item->company_name }}</p>
                                                            <p class="mb-2 item-name">{{ $item->name }}</p>

                                                            @if($item->chooseVariants->isNotEmpty())
                                                                @foreach($item->chooseVariants as $chooseVariant)
                                                                    @if($chooseVariant->available_same_day_delivery)
                                                                        <div class="mb-3 delivery-info">
                                                                            <p class="m-0">Eyni Gün Çatdırılma Mövcuddur</p>
                                                                        </div>
                                                                    @endif

                                                                        <p class="mb-1 price-display">₼<span class="variant-price">{{ number_format($item->price, 2) }}</span></p>


                                                                    @if($chooseVariant->variant_selection_title)
                                                                        <h6 class="mt-3 variant-title">{{ $chooseVariant->variant_selection_title }}</h6>
                                                                    @endif

                                                                    @php
                                                                        $variantData = is_string($chooseVariant->variants)
                                                                            ? json_decode($chooseVariant->variants, true)
                                                                            : $chooseVariant->variants;
                                                                    @endphp

                                                                    <div class="variants-buttons d-flex flex-wrap justify-content-center mt-2">
                                                                        @if(is_array($variantData))
                                                                            @foreach($variantData as $index => $variant)
                                                                                <button
                                                                                    class="btn btn-outline-secondary m-1 variant-button {{ $index === 0 ? 'active' : '' }}"
                                                                                    data-image="{{ asset('storage/' . $variant['image']) }}"
                                                                                    data-price="{{ $variant['price'] }}"
                                                                                >
                                                                                    {{ $variant['name'] ?? 'Unnamed Variant' }}
                                                                                </button>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>

                                                                        @if($chooseVariant->paragraph)
                                                                            <div class="variant-paragraph" id="paragraph-{{ $chooseVariant->id }}" data-full-text="{{ $chooseVariant->paragraph }}">
                                                                                <p class="content">{{ \Illuminate\Support\Str::limit($chooseVariant->paragraph, 200, ' ...') }}</p>
                                                                                <span class="show-more-btn" onclick="toggleText('paragraph-{{ $chooseVariant->id }}')">Show more</span>
                                                                            </div>
                                                                        @endif

                                                                        @if($chooseVariant->has_custom_text)
                                                                            <div class="mt-3">
       <textarea
           style="height: 40px; outline: none;"
           class="form-control custom-text"
           placeholder="{{ $chooseVariant->text_field_placeholder }}"
           rows="3"
       ></textarea>
                                                                            </div>
                                                                        @endif

                                                                    <button class="choose-box-choose-button"
                                                                            onclick="window.location.href='{{ route('choose.step', $currentStep + 1) }}'"
                                                                    >
                                                                        Qutuya əlavə et</button>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.querySelectorAll('.variant-button').forEach(button => {
                                            button.addEventListener('click', function() {
                                                const parentDiv = this.closest('.variants-buttons');
                                                parentDiv.querySelectorAll('.variant-button').forEach(btn => btn.classList.remove('active'));
                                                this.classList.add('active');

                                                const modalBody = this.closest('.modal-body');
                                                const imageElement = modalBody.querySelector('.variant-image');
                                                imageElement.src = this.dataset.image;

                                                const priceElement = modalBody.querySelector('.variant-price');
                                                priceElement.textContent = Number(this.dataset.price).toFixed(2);
                                            });
                                        });
                                    </script>
                                @endif
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

        </div>
        @include('front.build_a_box.selected-items-summary')

    </div>

@endsection

<script>
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
                        const response = await saveItemSelection({
                            choose_item_id: itemId,
                            item_name: itemName,
                            item_image: itemImage,
                            item_price: itemPrice,
                            user_text: null, // İstifadəçi mətn əlavə etmirsə
                            selected_variants: null // Variant seçimi yoxdursa
                        });

                        if (response.success) {
                            alert("Məhsul uğurla əlavə edildi!");
                        } else {
                            handleError(response.message);
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

// Xətaların idarə olunması
        function handleError(error) {
            console.error('Xəta baş verdi:', error);
            alert('Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.');
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

</script>

<style>
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.4) !important;
    }
    .modal {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-backdrop {
        display: none !important;
    }

    body.modal-open {
        overflow: hidden;
        padding-right: 0 !important;
    }
    /* Add these styles to your existing CSS */
    .form-control.is-invalid {
        border-color: #dc3545 !important;
        background-image: none !important;
        padding-right: 0.75rem !important;
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }

    .upload-container.is-invalid {
        border: 2px solid #dc3545 !important;
    }

    .invalid-feedback {
        display: none;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    .form-control.is-invalid ~ .invalid-feedback {
        display: block;
    }

    .custom-upload-box.is-invalid {
        border-color: #dc3545 !important;
    }

    /* New styles for variant validation */
    .variants-buttons.invalid {
        border-color: #dc3545 !important;
    }

    .variant-button {
        transition: all 0.3s ease;
    }

    .variant-button.active {
        border-color: #a3907a !important;
        background-color: #a3907a !important;
        color: white !important;
    }

</style>

