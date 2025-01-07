@extends('front.layouts.app')
@section('title', __('Hazır Hədiyyə Qutusu Seçin | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-premade.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">

@section('content')
    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
        @foreach (range(1, 3) as $stepNumber)
            <div class="choose-box-step">
                <div class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">{{ $stepNumber }}</div>
                <div class="choose-box-text">
                    <h3>{{ ['Qutu Seçin', 'Fərdiləşdirin', 'Tamamlandı'][$stepNumber - 1] }}</h3>
                    <p>{{ ['Seçdiyiniz qutunu seçin', 'Qutunuzu fərdiləşdirin', 'Sifarişi tamamlayın'][$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Qutu Seçin</h3>
            <p style="font-size: 14px; color: #898989">Hazır paketlərimizdən alış-veriş edin: Sizin üçün sürətli, əngəlsiz, göndərilməyə hazır hədiyyə qutuları.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Sifarişə davam etmək üçün aşağıdakı qutulardan seçiminizi edin!</p>
        </div>

        <hr class="mt-5 mb-5">

        <div>
            <div class="row">
                <!-- Sol Sidebar (Filtrləmə) -->
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

                <!-- Sağ Sidebar (Məhsullar) -->
                <div class="col-12 col-md-9">
                    <!-- Axtar və Sırala -->
                    <div class="d-flex justify-content-between mb-4">
                        <!-- Axtarış -->
                        <div class="search-container">
                            <input type="text" id="search-box" class="form-control" placeholder="Qutuları axtarın...">
                        </div>
                        <!-- Sırala -->
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

                    <!-- Məhsullar -->
                    <div class="row">
                        @foreach ($premadeBoxes as $box)
                            <div class="col-12 col-md-4 mb-4">
                                <div class="card w-100 h-100 d-flex flex-column align-items-stretch" style="border-color: transparent; cursor: pointer;">
                                    <div class="rounded">
                                        <div class="text-center position-relative image-container">
                                            <img src="https://wallpapers.com/images/hd/beautiful-sunset-pictures-ubxtuvfhpoampb6d.jpg"
                                                 alt="{{ $box->name }}" class="card-img-top rounded-top rounded-bottom normal-image">
                                            <img src="https://images.wallpaperscraft.com/image/single/firtrees_lake_mountains_22568_1280x720.jpg"
                                                 alt="{{ $box->name }}" class="card-img-top rounded-top rounded-bottom hover-image">
                                        </div>
                                    </div>

                                    <div class="card-block my-2" style="flex-grow: 1;">
                                        <h5 class="text-center text-theme h4 mb-1 text-capitalize font-butler">{{ $box->name }}</h5>
                                        <p class="card-text text-center font-avenir-black">₼ {{ number_format($box->price, 2) }}</p>
                                    </div>
                                    <div class="text-center small my-2">
                                        {{ $box->title }}
                                    </div>
                                    <div class="mt-1">
                                        <!-- Səbətə Əlavə -->
                                        <button class="w-100" data-bs-toggle="modal" data-bs-target="#modal-{{ $box->id }}">Səbətə Əlavə</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            @foreach($premadeBoxes as $box)
                                @php
                                    $boxDetail = $premadeBoxDetail->where('premade_box_id', $box->id)->first();
                                @endphp

                                <div class="modal" id="modal-{{ $box->id }}">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 1000px;">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-body p-4">
                                                <div class="d-flex flex-column flex-md-row gap-4">
                                                    <!-- Görsel Slider -->
                                                    <div class="slider-container position-relative" style="width: 480px; flex-shrink: 0;">
                                                        <div class="slider" id="slider-{{ $box->id }}">
                                                            @if($boxDetail && $boxDetail->images)
                                                                @foreach((is_string($boxDetail->images) ? json_decode($boxDetail->images) : $boxDetail->images) as $image)
                                                                    <img src="{{ asset('storage/' . $image) }}" class="slider-item" alt="Box Image">
                                                                @endforeach
                                                            @else
                                                                <p>No images available</p>
                                                            @endif
                                                        </div>
                                                        <button class="slider-prev">‹</button>
                                                        <button class="slider-next">›</button>
                                                    </div>

                                                    <!-- Ürün Detayları -->
                                                    <div style="flex-grow: 1;">
                                                        <h2 class="mb-2" style="color: #a3907a;">{{ $box->name }}</h2>
                                                        <p class="mb-3" style="color: #212529; font-size: 20px !important; font-weight: 500">₼ {{ $box->price }}</p>
                                                        @if($boxDetail && $boxDetail->paragraph)
                                                            <p style="color: #898989; line-height: 1.6; font-size: 12px">{{ $boxDetail->paragraph }}</p>
                                                        @else
                                                            <p>Details not available.</p>
                                                        @endif

                                                        <!-- What's Inside -->
                                                        <div id="accordionInside" class="accordion">
                                                            <div id="heading-inside">
                                                                <h2 class="mb-0 text-center">
                                                                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-inside"
                                                                            class="pt-0 btn btn-header-link pl-md-0 text-theme h5 text-center collapse-button px-3 collapsed"
                                                                            aria-expanded="false">
                                                                        <span class="mr-1" style="color: #898989; font-size: 12px">What's Inside</span>
                                                                    </button>
                                                                </h2>
                                                            </div>
                                                            <div id="collapse-inside" aria-labelledby="heading-inside" data-bs-parent="#accordionInside" class="collapse">
                                                                <div class="d-flex flex-column align-items-center pb-3">
                                                                    <div style="max-width: 80vw !important;">
                                                                        <!-- Ürün 1 -->
                                                                        <div class="d-flex align-items-center pb-3">
                                                                            <img src="https://i.pinimg.com/736x/50/70/42/50704251b87db32e6998b19be844baf3.jpg" alt="item 1" style="width: 35px; height: 35px; object-fit: contain;">
                                                                            <div class="d-flex flex-column justify-content-center pl-3">
                                                                                <p class="d-block d-md-none font-butler text-theme-secondary text-capitalize mb-0">
                                                                                    item 1 - description
                                                                                </p>
                                                                                <p class="d-none d-md-block font-butler text-theme-secondary text-capitalize mb-0 small">
                                                                                    item 1 - description
                                                                                </p>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Ürün 2 -->
                                                                        <div class="d-flex align-items-center pb-3">
                                                                            <img src="https://a.d-cd.net/9f03bd6s-1920.jpg" alt="item 2" style="width: 35px; height: 35px; object-fit: contain;">
                                                                            <div class="d-flex flex-column justify-content-center pl-3">
                                                                                <p class="d-block d-md-none font-butler text-theme-secondary text-capitalize mb-0">
                                                                                    item 2 - description
                                                                                </p>
                                                                                <p class="d-none d-md-block font-butler text-theme-secondary text-capitalize mb-0 small">
                                                                                    item 2 - description
                                                                                </p>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Ürün 3 -->
                                                                        <div class="d-flex align-items-center pb-3">
                                                                            <img src="https://i.pinimg.com/736x/f6/1d/b1/f61db1def1ad3610dd463644bcc6fc36.jpg" alt="item 3" style="width: 35px; height: 35px; object-fit: contain;">
                                                                            <div class="d-flex flex-column justify-content-center pl-3">
                                                                                <p class="d-block d-md-none font-butler text-theme-secondary text-capitalize mb-0">
                                                                                    item 3 - description
                                                                                </p>
                                                                                <p class="d-none d-md-block font-butler text-theme-secondary text-capitalize mb-0 small">
                                                                                    item 3 - description
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button
                                                            type="button"
                                                            class="choose-box-customize-button"
                                                            style="position: absolute; right: 55px; bottom: 35px;"
                                                        >
                                                            Tənzimləmək
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Gerekli olan JavaScript ve Bootstrap JS yüklemeleri -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelectorAll('.slider-container').forEach(container => {
        const slider = container.querySelector('.slider');
        const items = container.querySelectorAll('.slider-item');
        const prevButton = container.querySelector('.slider-prev');
        const nextButton = container.querySelector('.slider-next');

        let currentIndex = 0;

        const updateSlider = () => {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        };

        prevButton.addEventListener('click', () => {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
            updateSlider();
        });

        nextButton.addEventListener('click', () => {
            currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
            updateSlider();
        });
    });

    document.getElementById("menuButton").addEventListener("click", function() {
        var menu = document.getElementById("menu");
        if (menu.style.display === "none" || menu.style.display === "") {
            menu.style.display = "block"; // Aç
        } else {
            menu.style.display = "none"; // Kapat
        }
    });
</script>

<style>
    h2 {
        text-align: center !important;
    }

    .slider-container {
        position: relative;
        overflow: hidden;
        height: 400px;
    }

    .slider {
        display: flex;
        transition: transform 0.3s ease-in-out;
    }

    .slider-item {
        min-width: 100%;
        height: 400px;
        object-fit: contain;
    }

    .slider-prev, .slider-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        z-index: 10;
    }

    .slider-prev {
        left: 10px;
    }

    .slider-next {
        right: 10px;
    }
</style>
