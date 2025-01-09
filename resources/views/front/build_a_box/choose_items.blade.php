@extends('front.layouts.app')
@section('title', __('Hədiyyə Qutusu Yaradın | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-items.css') }}">
@section('content')
    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
        @foreach (range(1, 4) as $stepNumber)
            <div class="choose-box-step">
                <a href="{{ route('choose.step', $stepNumber) }}" style="text-decoration: none" class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">
                    {{ $stepNumber }}
                </a>
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
                                    <div class="card text-center border-0">
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
                                        <button class="choose-items-button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-{{ $item->id }}">
                                            {{ $item->button }}
                                        </button>
                                    </div>
                                </div>

                                <!-- Modals -->
                                @if($item->button == 'Custom Product')
                                    <!-- Custom Product Modal -->
                                    <div class="modal fade" id="modal-{{ $item->id }}" tabindex="-1" aria-labelledby="customProductModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="customProductModalLabel">Custom Product Modal</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Custom Product Modal Content -->
                                                    <p>Details for Custom Product: {{ $item->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif($item->button == 'Choose Variant')
                                        <!-- Choose Variant Modal -->
                                        <div class="modal fade" id="modal-{{ $item->id }}" tabindex="-1" aria-labelledby="chooseVariantModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 60%;">
                                                <div class="modal-content rounded-4">
                                                    <div class="modal-body d-flex justify-content-between">
                                                        <!-- Left Section: Image Slider -->
                                                        <div class="col-md-6" style="max-width: 380px; height: 390px; overflow: hidden; background-color: #f8f9fa;">
                                                            <div id="carousel-{{ $item->id }}" class="carousel slide w-100 h-100" data-bs-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @if($item->chooseVariants->isNotEmpty())
                                                                        @foreach($item->chooseVariants as $variantKey => $chooseVariant)
                                                                            @php
                                                                                $variantData = is_string($chooseVariant->variants)
                                                                                    ? json_decode($chooseVariant->variants, true)
                                                                                    : $chooseVariant->variants;
                                                                            @endphp

                                                                            @if(is_array($variantData))
                                                                                @foreach($variantData as $index => $variant)
                                                                                    <div class="carousel-item {{ $variantKey === 0 && $index === 0 ? 'active' : '' }}">
                                                                                        <img
                                                                                            src="{{ asset('storage/' . $variant['image']) }}"
                                                                                            class="d-block w-100 h-100"
                                                                                            style="object-fit: cover;"
                                                                                            alt="{{ $variant['name'] ?? '' }}"
                                                                                        >
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </div>

                                                                @if($item->chooseVariants->isNotEmpty())
                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $item->id }}" data-bs-slide="prev">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $item->id }}" data-bs-slide="next">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Next</span>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <!-- Right Section: Data -->
                                                        <div class="col-md-6 d-flex flex-column text-center">
                                                            <p class="mb-2" style="color: #898989; font-size: 14px;">{{ $item->company_name }}</p>
                                                            <p class="mb-2" style="color: #a3907a; font-size: 21px; font-weight: 600">{{ $item->name }}</p>
                                                            <p class="mb-2 text-muted price-display" style="color: #212529; font-size: 20px !important; font-weight: 500">₼{{ number_format($item->price, 2) }}</p>

                                                            @if($item->chooseVariants->isNotEmpty())
                                                                @foreach($item->chooseVariants as $chooseVariant)
                                                                    @if($chooseVariant->available_same_day_delivery)
                                                                        <div class="mb-3 bg-opacity-10 rounded">
                                                                            <p class="m-0 text-success" style="color: #898989!important; font-style: italic; font-weight: 500; font-size: 12px">
                                                                                Eyni Gün Çatdırılma Mövcuddur
                                                                            </p>
                                                                        </div>
                                                                    @endif

                                                                    @if($chooseVariant->variant_selection_title)
                                                                        <h6 class="mt-3" style="color: #9e0b0f; font-size: 15px; font-weight: 500">{{ $chooseVariant->variant_selection_title }}</h6>
                                                                    @endif

                                                                    @php
                                                                        $variantData = is_string($chooseVariant->variants)
                                                                            ? json_decode($chooseVariant->variants, true)
                                                                            : $chooseVariant->variants;
                                                                    @endphp

                                                                    <div class="variants-buttons d-flex flex-wrap justify-content-center mt-2">
                                                                        @if(is_array($variantData))
                                                                            @foreach($variantData as $variant)
                                                                                <button class="btn btn-outline-secondary m-1 variant-button">
                                                                                    {{ $variant['name'] ?? 'Unnamed Variant' }}
                                                                                </button>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>

                                                                    @if($chooseVariant->paragraph)
                                                                        <p class="mt-3" style="color: #898989; font-size: 14px">{{ $chooseVariant->paragraph }}</p>
                                                                    @endif

                                                                        <button
                                                                            class="choose-box-choose-button"
                                                                        >
                                                                            Add to box
                                                                        </button>
                                                                @endforeach

                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

<script>
    document.querySelectorAll('.choose-box-circle').forEach(circle => {
        circle.addEventListener('click', function (e) {
            const step = this.textContent.trim();
            window.location.href = `/choose-step/${step}`;
        });
    });

</script>

<style>
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.4) !important;
    }
</style>

