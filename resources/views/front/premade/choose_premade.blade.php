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

        @foreach ($premadeBoxes as $box)
            @foreach (range(1, 3) as $stepNumber)
                <div
                    class="choose-box-step"
                    onclick="window.location.href='{{ route($routes[$stepNumber], $box->id) }}'"
                    style="cursor: pointer;"
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
                            @php
                                $boxDetail = $box->details->first();
                                $uniqueCarouselId = "boxCarousel_{$box->id}";
                                $uniqueModalId = "modal_{$box->id}";
                            @endphp
                            <div class="col-12 col-md-4 mb-4">
                                <div class="card w-100 h-100 d-flex flex-column align-items-stretch" style="border-color: transparent; cursor: pointer;">
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
                                        <h5 class="text-center text-theme h4 mb-1 text-capitalize font-butler">{{ $box->name }}</h5>
                                        <p class="card-text text-center font-avenir-black">₼ {{ number_format($box->price, 2) }}</p>
                                    </div>
                                    <div class="text-center small my-2">
                                        {{ $box->title }}
                                    </div>
                                    <div class="mt-1">
                                        <!-- Səbətə Əlavə -->
                                        <button class="w-100" data-bs-toggle="modal" data-bs-target="#{{ $uniqueModalId }}">Səbətə Əlavə</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal" id="{{ $uniqueModalId }}">
                                <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 1000px;">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-body p-4">
                                            <div class="d-flex flex-column flex-md-row gap-4">
                                                <!-- Slider -->
                                                <div class="slider-container position-relative" style="height: 340px; width: 360px; overflow: hidden;">
                                                    <div class="slider" id="{{ $uniqueCarouselId }}">
                                                        @if($boxDetail && $boxDetail->images)
                                                            @foreach((is_string($boxDetail->images) ? json_decode($boxDetail->images) : $boxDetail->images) as $image)
                                                                <img src="{{ asset('storage/' . $image) }}" class="slider-item d-block w-100 h-100 object-fit-cover"
                                                                     alt="Box Image">
                                                            @endforeach
                                                        @else
                                                            <p>No images available</p>
                                                        @endif
                                                    </div>
                                                    <button class="slider-prev">‹</button>
                                                    <button class="slider-next">›</button>
                                                </div>

                                                <!-- Details -->
                                                <div style="flex-grow: 1; position: relative; padding-bottom: 60px;">
                                                    <h2 class="mb-2" style="color: #a3907a;">{{ $box->name }}</h2>
                                                    <p class="mb-3" style="color: #212529; font-size: 20px !important; font-weight: 500">₼ {{ $box->price }}</p>
                                                    @if($boxDetail && $boxDetail->paragraph)
                                                        <div data-v-231e0cc6="" class="font-avenir-light mb-3">
                                                            <p data-v-231e0cc6="" class="mb-0 text-center description text-theme-secondary" style="overflow-wrap: break-word;">
                                                                @if(strlen($boxDetail->paragraph) > 100)
                                                                    <span class="short-paragraph">{{ substr($boxDetail->paragraph, 0, 100) }}...</span>
                                                                    <span class="d-none full-paragraph">{{ $boxDetail->paragraph }}</span>
                                                                @else
                                                                    <span>{{ $boxDetail->paragraph }}</span>
                                                                @endif
                                                            </p>
                                                            @if(strlen($boxDetail->paragraph) > 100)
                                                                <div class="text-center mb-2">
                                                                    <a href="javascript:void(0);" class="toggle-button" style="font-size: 12px; font-weight: normal" onclick="toggleParagraph(this)">Show More</a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <p>Details not available.</p>
                                                    @endif

                                                    <!-- What's Inside -->
                                                    @foreach($premadeBoxes as $box)
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
                                                    @endforeach

                                                    <!-- Customize Button -->
                                                    <div>
                                                        <button
                                                            type="button"
                                                            class="choose-box-customize-button"
                                                            style="position: absolute; right: 55px; bottom: 35px;"
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
