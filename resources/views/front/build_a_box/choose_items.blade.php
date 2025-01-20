@extends('front.layouts.app')
@section('title', __('Hədiyyə Qutusu Yaradın | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-items.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
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
                <div class="choose-box-text">
                    <h3>{{ ['Qutu Seçin', 'Əşyaları Seçin', 'Kart Seçin', 'Tamamlandı'][$stepNumber - 1] }}</h3>
                    <p>{{ ['Seçdiyiniz qutunu seçin', 'Əşyaları əlavə edin', 'Təbrik kartını seçin', 'Sifarişi tamamlayın'][$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%; margin-bottom: 90px!important;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Məhsulları seçin</h3>
            <p style="font-size: 14px; color: #898989">Sizin üçün ən yaxşı məhsulları seçdik.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Aşağıdakı məhsulları seçin, qutunu doldurun və özəlləşdirin!</p>
        </div>

        <hr style="color: #898989">

        <div class="gy-4 mt-4" style="margin-top: 30px!important;">

            <div>
                <div class="row">
                    <!-- Sol Sidebar (Filtrləmə) -->
                    <div class="col-12 col-md-3 filter-column">
                        <div class="filters" style="background-color: white !important; border: 1px solid #ccc !important;">
                            <h5 class="filter-head">Məhsulları Filtrləyin</h5>

                            <!-- Kategori Filtresi -->
                            <div class="filter-section my-4">
                                <label class="filter-label mb-2">Kateqoriya</label>
                                <div class="filter-buttons">
                                    @foreach($categories as $category)
                                        <button class="filter-btn"
                                                data-filter="category"
                                                data-value="{{ $category['name'] }}">
                                            {{ $category['name'] }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Hazırlanma Müddəti -->
                            <div class="filter-section mb-4">
                                <label class="filter-label mb-2">Hazırlanma müddəti</label>
                                <div class="filter-buttons">
                                    @foreach($production_times as $production_time)
                                        <button class="filter-btn"
                                                data-filter="production_time"
                                                data-value="{{ $production_time['name'] }}">
                                            {{ $production_time['name'] }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Qiymət Aralığı -->
                            <div class="filter-section mb-4">
                                <label class="filter-label mb-2">Qiymət Aralığı</label>
                                <div class="price-range-container">
                                    <div class="price-inputs d-flex gap-2">
                                        <input type="number"
                                               class="form-control form-control-sm"
                                               id="min-price"
                                               placeholder="Min">
                                        <input type="number"
                                               class="form-control form-control-sm"
                                               id="max-price"
                                               placeholder="Max">
                                    </div>
                                    <button class="filter-btn w-100 mt-2"
                                            data-filter="price">
                                        Tətbiq et
                                    </button>
                                </div>
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
                                    <option value="default" style="color: #a3907a">Sırala: Varsayılan</option>
                                    <option value="price_asc">Qiymət: Artan</option>
                                    <option value="price_desc">Qiymət: Azalan</option>
                                    <option value="name_asc">Ad: A-dan Z-yə</option>
                                    <option value="name_desc">Ad: Z-dən A-ya</option>
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            @foreach ($chooseItems as $item)
                                <div class="col-md-4 mb-4 choose_items"
                                     data-recipient="{{ $item->category }}"
                                     data-production_time="{{ $item->production_time }}"
                                     data-price="{{ $item->price }}">

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

                                                                    <button class="choose-variant-button">Qutuya əlavə et</button>
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

<script src="{{ asset('assets/front/js/test.js') }}"></script>
