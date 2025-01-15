@extends('front.layouts.app')
@section('title', __('Hazır Hədiyyə Qutusu Seçin | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-premade.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
        @php
            $routes = [
                1 => 'choose_premade_box',
                2 => 'customize_premade_box',
                3 => 'done_premade'
            ];

            $stepTitles = ['Qutu Seçin', 'Fərdiləşdirin', 'Tamamlandı'];
            $stepDescriptions = ['Seçdiyiniz qutunu seçin', 'Qutunuzu fərdiləşdirin', 'Sifarişi tamamlayın'];
        @endphp

        @foreach (range(1, 3) as $stepNumber)
            <div
                class="choose-box-step"
                @if($stepNumber < 3)
                    @if($stepNumber == 2)
                        onclick="window.location.href='{{ isset($selectedBoxId) ? route($routes[$stepNumber], $selectedBoxId) : route($routes[$stepNumber]) }}'"
                @else
                    onclick="window.location.href='{{ route($routes[$stepNumber]) }}'"
                @endif
                style="cursor: pointer;"
                @endif
            >
                <div class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">
                    {{ $stepNumber }}
                </div>
                <div class="choose-box-text">
                    <h3>{{ $stepTitles[$stepNumber - 1] }}</h3>
                    <p>{{ $stepDescriptions[$stepNumber - 1] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc;">
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
                        <div class="filter-section mb-4">
                            <label class="filter-label mb-2">Alıcı</label>
                            <div class="filter-buttons">
                                @foreach($recipients as $recipient)
                                    <button class="filter-btn" data-filter="recipient" data-value="{{ $recipient->id }}">
                                        {{ $recipient }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Xüsusi Günlər -->
                        <div class="filter-section mb-4">
                            <label class="filter-label mb-2">Xüsusi Günlər</label>
                            <div class="filter-buttons">
                                @foreach($occasions as $occasion)
                                    <button class="filter-btn" data-filter="occasion" data-value="{{ $occasion->id }}">
                                        {{ $occasion }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Qiymət Aralığı -->
                        <div class="filter-section mb-4">
                            <label class="filter-label mb-2">Qiymət Aralığı</label>
                            <div class="price-range-container">
                                <div class="price-inputs d-flex gap-2">
                                    <input type="number" class="form-control form-control-sm" id="min-price" placeholder="Min">
                                    <input type="number" class="form-control form-control-sm" id="max-price" placeholder="Max">
                                </div>
                                <button class="filter-btn w-100 mt-2" data-filter="price">Tətbiq et</button>
                            </div>
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
                            @php
                                $boxDetail = $box->details;
                                $uniqueCarouselId = "boxCarousel_{$box->id}";
                                $uniqueModalId = "modal_{$box->id}";
                            @endphp
                            <div class="col-12 col-md-4 mb-4">
                                <div class="card w-100 h-100 d-flex flex-column align-items-center" style="border-color: transparent; cursor: pointer;">
                                    <div class="rounded">
                                        <div class="text-center position-relative image-container" style="height: 200px; width: 200px; overflow: hidden;">
                                            <!-- Normal Image -->
                                            <img
                                                src="{{ asset('storage/' . $box->normal_image) }}"
                                                alt="{{ $box->name }}"
                                                class="card-img-top rounded-top rounded-bottom d-block w-100 h-100 object-fit-cover"
                                            >

                                            <!-- Hover Image -->
                                            @if ($box->hover_image)
                                                <img
                                                    src="{{ asset('storage/' . $box->hover_image) }}"
                                                    alt="{{ $box->name }}"
                                                    class="card-img-top rounded-top rounded-bottom d-block w-100 h-100 object-fit-cover"
                                                >
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-block my-2" style="flex-grow: 1;">
                                        <h6 class="gift-box-title">{{ $box->title }}</h6>
                                        <div class="gift-box-name">
                                            {{ $box->name }}
                                        </div>
                                    </div>
                                    <p class="gift-box-price">₼ {{ number_format($box->price, 2) }}</p>
                                    <div class="mt-1" style="text-align: center !important;">
                                        <!-- Səbətə Əlavə -->
                                        <button class="choose-box-choose-button" style="text-align: center" data-bs-toggle="modal" data-bs-target="#{{ $uniqueModalId }}">Səbətə Əlavə</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal" id="{{ $uniqueModalId }}">
                                <div class="modal-dialog modal-dialog-centered rounded-4" style="max-width: 800px">
                                    <div class="modal-content rounded-4">

                                        <div class="modal-body p-4">
                                            <div class="d-flex align-items-start gap-4">
                                                <!-- Slider -->
                                                <div class="position-relative" style="width: 360px; flex-shrink: 0;">

                                                    <div class="carousel slider" id="{{ $uniqueCarouselId }}" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @if($premadeBoxDetail && !empty($premadeBoxDetail->images))
                                                                @foreach($premadeBoxDetail->images as $key => $image)
                                                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                                        <div style="height: 340px; width: 360px; overflow: hidden;">
                                                                            <img src="{{ asset('storage/' . $image) }}"
                                                                                 class="slider-item d-block w-100 h-100 object-fit-cover"
                                                                                 alt="Box Image">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="carousel-item active">
                                                                    <div style="height: 340px; width: 360px; overflow: hidden;">
                                                                        <img src="{{ asset('storage/' . $box->normal_image) }}"
                                                                             class="slider-item d-block w-100 h-100 object-fit-cover"
                                                                             alt="Box Image">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{--                                                    <button class="slider-prev">‹</button>--}}
                                                    {{--                                                    <button class="slider-next">›</button>--}}
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $uniqueCarouselId }}" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Əvvəlki</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $uniqueCarouselId }}" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true" style="padding: 12px;"></span>
                                                        <span class="visually-hidden">Sonrakı</span>
                                                    </button>
                                                </div>

                                                <!-- Details -->
                                                <div class="flex-grow-1">
                                                    <div class="text-start">
                                                        <h2 class="mb-2" style="color: #898989; font-size: 14px;">{{ $box->title }}</h2>
                                                        <div class="gift-box-name" style="font-size: 21px; font-weight: 600">
                                                            {{ $box->name }}
                                                        </div>
                                                        <p class="mb-3" style="color: #212529; font-size: 20px !important; font-weight: 500">₼ {{ $box->price }}</p>
                                                        @if($box->details->first() && $box->details->first()->paragraph)
                                                            <div data-v-231e0cc6="" class="font-avenir-light mb-3">
                                                                <p data-v-231e0cc6="" class="mb-0 text-center description text-theme-secondary" style="overflow-wrap: break-word;">
                                                                    @if(strlen($box->details->first()->paragraph) > 100)
                                                                        <span class="short-paragraph">{{ substr($box->details->first()->paragraph, 0, 100) }}...</span>
                                                                        <span class="d-none full-paragraph">{{ $box->details->first()->paragraph }}</span>
                                                                    @else
                                                                        <span>{{ $box->details->first()->paragraph }}</span>
                                                                    @endif
                                                                </p>
                                                                @if(strlen($box->details->first()->paragraph) > 100)
                                                                    <div class="text-center mb-2">
                                                                        <a href="javascript:void(0);" class="toggle-button" style="font-size: 12px; font-weight: normal" onclick="toggleParagraph(this)">Show More</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <p>Details not available.</p>
                                                        @endif
                                                    </div>

                                                    <!-- What's Inside -->
                                                    <div class="accordion mb-4">
                                                        <div class="accordion-header">
                                                            <h2 class="mb-0 text-center">
                                                                <button type="button"
                                                                        class="pt-0 btn btn-header-link pl-md-0 text-theme h5 text-center collapse-button px-3"
                                                                        onclick="toggleAccordion('collapse-inside-{{ $box->id }}')">
                                                                    <span class="mr-1" style="color: #898989; font-size: 12px">What's Inside</span>
                                                                </button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapse-inside-{{ $box->id }}" class="collapse-content">
                                                            <div class="collapse-inner">
                                                                <div class="d-flex flex-column align-items-center pb-3">
                                                                    <div style="max-width: 80vw !important;">
                                                                        @foreach($box->insidings as $insiding)
                                                                            <div class="d-flex align-items-center pb-3 gap-3">
                                                                                <img src="{{ $insiding->image }}"
                                                                                     alt="{{ $insiding->name }}"
                                                                                     style="width: 35px; height: 35px; object-fit: contain;">
                                                                                <div class="d-flex flex-column justify-content-start pl-3">
                                                                                    <p class="font-butler text-theme-secondary text-capitalize mb-0">
                                                                                        {{ $insiding->name }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Customize Button -->
                                                    <div>
                                                        <button
                                                            type="button"
                                                            class="choose-box-customize-button"
                                                            onclick="window.location.href='{{ route('customize_premade_box', $box->id) }}'"
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS ve Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

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

    function toggleParagraph(link) {
        const container = link.closest('.font-avenir-light');
        const shortParagraph = container.querySelector('.short-paragraph');
        const fullParagraph = container.querySelector('.full-paragraph');

        if (shortParagraph && fullParagraph) {
            if (fullParagraph.classList.contains('d-none')) {
                shortParagraph.classList.add('d-none');
                fullParagraph.classList.remove('d-none');
                link.textContent = "Show Less";
            } else {
                shortParagraph.classList.remove('d-none');
                fullParagraph.classList.add('d-none');
                link.textContent = "Show More";
            }
        }
    }

    function toggleAccordion(id) {
        const content = document.getElementById(id);
        const allContents = document.querySelectorAll('.collapse-content');

        allContents.forEach(item => {
            if (item.id !== id && item.style.height !== '0px') {
                item.style.height = '0px';
            }
        });

        if (content.style.height === '0px' || content.style.height === '') {
            content.style.height = content.scrollHeight + 'px';
        } else {
            content.style.height = '0px';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const contents = document.querySelectorAll('.collapse-content');
        contents.forEach(content => {
            content.style.height = '0px';
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const boxes = document.querySelectorAll('.col-12.col-md-4');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filterType = this.dataset.filter;
                const filterValue = this.dataset.value;

                document.querySelectorAll(`[data-filter="${filterType}"]`).forEach(btn => {
                    btn.classList.remove('active');
                });

                this.classList.add('active');

                filterBoxes();
            });
        });

        function filterBoxes() {
            const activeFilters = {
                recipient: getActiveFilter('recipient'),
                occasion: getActiveFilter('occasion'),
                price: getPriceFilter()
            };

            boxes.forEach(box => {
                const shouldShow = checkFilters(box, activeFilters);
                box.style.display = shouldShow ? 'block' : 'none';
            });
        }

        function getActiveFilter(filterType) {
            const activeButton = document.querySelector(`.filter-btn[data-filter="${filterType}"].active`);
            return activeButton ? activeButton.dataset.value : null;
        }

        function getPriceFilter() {
            const minPrice = document.getElementById('min-price').value;
            const maxPrice = document.getElementById('max-price').value;
            return {min: minPrice, max: maxPrice};
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        console.log('Bulunan filter butonları:', filterButtons.length);

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                console.log('Tıklanan buton:', this.dataset.filter, this.dataset.value);
                const filterType = this.dataset.filter;
                const filterValue = this.dataset.value;

                // Test için
                console.log('Aktif filtreler:', {
                    type: filterType,
                    value: filterValue
                });
            });
        });
    });
</script>

<style>
    .filters {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    }

    .filter-label {
        color: #666;
        font-weight: 500;
        font-size: 14px;
    }

    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .filter-btn {
        background: white;
        border: 1px solid #ddd;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        color: #666;
        transition: all 0.3s ease;
    }

    .filter-btn:hover {
        background: #a3907a;
        color: white;
        border-color: #a3907a;
    }

    .filter-btn.active {
        background: #a3907a;
        color: white;
        border-color: #a3907a;
    }

    .price-range-container {
        background: white;
        padding: 10px;
        border-radius: 8px;
    }
</style>
<style>
        /* Box grid düzenlemeleri */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .col-12.col-md-4 {
        padding: 15px;
        display: flex;
    }

    @media (min-width: 768px) {
        .col-12.col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        /* İki box olduğunda ortalama için */
        .row:not(:empty) {
            justify-content: flex-start;
        }
    }

    .card {
        width: 100%;
        height: 100%;
        margin: 0;
    }

        /* Filtre bölümü için */
        .filters {
            background: transparent;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        /* Box'lar için */
        .col-12.col-md-4 {
            padding: 15px;  /* Orijinal padding'i koruyoruz */
            display: flex;
        }

        @media (min-width: 768px) {
            .col-12.col-md-4 {
                flex: 0 0 33.333333%;  /* 3 sütunlu yapıyı koruyoruz */
                max-width: 33.333333%;
            }
        }

        /* Box içeriği için */
        .card {
            width: 80%;
            height: auto;
            margin: 0;
            padding: 15px;
        }

        .image-container {
            height: 250px !important;  /* Resim boyutunu büyüttük */
            width: 250px !important;   /* Resim boyutunu büyüttük */
            margin: 0 auto;
        }

        .gift-box-title {
            font-size: 1.1rem;  /* Başlık boyutunu büyüttük */
            margin-top: 15px;
        }

        .gift-box-name {
            font-size: 1rem;  /* İsim boyutunu büyüttük */
        }

        .gift-box-price {
            font-size: 1.1rem;  /* Fiyat boyutunu büyüttük */
        }

        /* Sepete Ekle butonu için */
        .choose-box-choose-button {
            display: block;
            margin: 0 auto;
            width: fit-content;
        }

        .card .mt-1 {
            text-align: center;
            width: 100%;
        }

        /* 1100px altında 2 sütunlu görünüm */
        @media (max-width: 1100px) {
            .col-12.col-md-4 {
                flex: 0 0 45% !important;     /* Genişliği artırdık */
                max-width: 45% !important;    /* Genişliği artırdık */
                padding: 8px !important;
            }

            .image-container {
                height: 250px !important;     /* Resim boyutunu ayarladık */
                width: 250px !important;
            }

            /* Filter kısmı için */
            .col-12.col-md-3 {
                flex: 0 0 100% !important;
                max-width: 100% !important;
                margin-bottom: 20px;
            }

            /* Filter butonlarının yatayda daha iyi dağılması için */
            .filter-buttons {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                justify-content: flex-start;
            }
        }

        /* Mobil görünüm için */
        @media (max-width: 767px) {
            .col-12.col-md-4 {
                flex: 0 0 100% !important;  /* Tek sütun */
                max-width: 100% !important;
            }
        }

        /* Header yazıları için genel stil */
        .choose-boxes-header {
            line-height: normal !important;  /* line-height'ı düzelttik */
            margin-bottom: 30px;
        }

        .choose-boxes-header h3 {
            margin-bottom: 15px !important;
        }

        .choose-boxes-header p {
            margin-bottom: 12px !important;
        }

        /* Responsive düzenlemeler */
        @media (max-width: 1100px) {
            .choose-boxes-header h3 {
                font-size: 1.5rem !important;
            }

            .choose-boxes-header p {
                font-size: 13px !important;
                line-height: 1.4 !important;
                margin-bottom: 10px !important;
            }
        }

        @media (max-width: 767px) {
            .choose-boxes-header {
                padding: 0 10px;
            }

            .choose-boxes-header h3 {
                font-size: 1.3rem !important;
            }

            .choose-boxes-header p {
                font-size: 12px !important;
                line-height: 1.3 !important;
            }
        }

        @media (max-width: 767px) {
            .col-12.col-md-4 {
                flex: 0 0 31% !important;     /* Genişliği artırdık */
                max-width: 31% !important;    /* Genişliği artırdık */
                padding: 5px !important;
            }

            .image-container {
                height: 150px !important;     /* Resim boyutunu büyüttük */
                width: 150px !important;
            }

            .card {
                padding: 8px !important;
            }

            .gift-box-title {
                font-size: 0.9rem !important;  /* Font boyutunu büyüttük */
            }

            .gift-box-name {
                font-size: 0.85rem !important;
            }

            .gift-box-price {
                font-size: 0.9rem !important;
            }

            .choose-box-choose-button {
                padding: 6px 12px;
                font-size: 0.75rem;
            }
        }

        /* Daha da küçük ekranlarda 2'li sıralama */
        @media (max-width: 575px) {
            .col-12.col-md-4 {
                flex: 0 0 45% !important;     /* Genişliği artırdık */
                max-width: 45% !important;    /* Genişliği artırdık */
            }

            .image-container {
                height: 180px !important;     /* Resim boyutunu büyüttük */
                width: 180px !important;
            }
        }

        @media (max-width: 440px) {
            .col-12.col-md-4 {
                flex: 0 0 45% !important;
                max-width: 45% !important;
                padding: 4px !important;
            }

            .image-container {
                height: 140px !important;
                width: 140px !important;
            }

            .card {
                padding: 5px !important;
            }

            /* Font boyutlarını küçülttük */
            .gift-box-title {
                font-size: 0.8rem !important;
                margin-top: 8px !important;
            }

            .gift-box-name {
                font-size: 0.75rem !important;
            }

            .gift-box-price {
                font-size: 0.8rem !important;
                margin-bottom: 5px !important;
            }

            /* Butonu küçülttük */
            .choose-box-choose-button {
                padding: 4px 8px !important;
                font-size: 0.7rem !important;
            }
        }
</style>
