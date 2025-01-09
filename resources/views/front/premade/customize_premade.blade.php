@extends('front.layouts.app')
@section('title', __('Hazır Hədiyyə Qutusu Seçin | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-premade.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


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

    <div class="container my-5 p-5 choose-boxes-page" style="background-color: #ffffff; max-width: 1150px!important; border-radius: 20px">
        <div class="choose-boxes-header text-center" style="line-height: 0.5">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Qutunuzu fərdiləşdirin</h3>
            <p style="font-size: 14px; color: #898989">Qutunu, Kartı seçin və Məhsulları Fərdiləşdirin.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Sifarişi tamamlamaq üçün seçdiyiniz qutunun içərisindəkilərə nəzər yetirin!</p>
        </div>

        <div class="container mt-5">
            <div id="accordion">
                <div class="mt-5 w-100" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
                    <!-- Heading və Collapse bölməsi -->
                    <div class="border-theme-secondary pb-3" style="border-bottom-left-radius: 0rem; border-bottom-right-radius: 0rem; border-bottom-width: 0px !important;">
                        <h2 class="mb-0 d-flex flex-column pt-2">
                            <button type="button" class="d-flex flex-row mb-0 btn btn-header-link w-100 text-theme h2 text-left collapse-button pb-0 pt-3 pl-3 pr-3"
                                    data-toggle="collapse" data-target="#collapse-67dbcf95-11ee-4ff5-b8cb-856d23df54f3" aria-expanded="false"
                                    aria-controls="collapse-67dbcf95-11ee-4ff5-b8cb-856d23df54f3"
                                    style="background: none; border: none; outline: none; color: inherit; box-shadow: none;">
                                <div class="flex-grow-1 d-flex flex-md-row flex-column align-items-md-center">
                                    <span class="font-butler text-capitalize mb-0 h4" style="color: #a3907a;">Box adi</span>
                                    <br class="w-100 d-block d-md-none mb-0">
                                    <span class="mb-0 font-avenir-light recipient-name-text-0 h5"></span>
                                </div>
                                <div class="d-flex justify-content-end mr-4">
                                    <div style="cursor: pointer;">
                                        <i class="far fa-trash-alt h5 mb-0 text-theme-secondary"></i>
                                    </div>
                                </div>
                            </button>
                        </h2>
                    </div>

                    <!-- Collapse bölməsi -->
                    <div id="collapse-67dbcf95-11ee-4ff5-b8cb-856d23df54f3" class="collapse show w-100" aria-labelledby="heading-67dbcf95-11ee-4ff5-b8cb-856d23df54f3" data-parent="#accordion">
                        <div class="row">
                            <!-- Sol tərəf: Qutular -->
                            <div class="col-md-6">
                                <p data-v-11909900="" class="font-avenir-black text-theme-secondary mt-4 ps-3 text-left" style="color: #898989; font-size: 14px; font-weight: 600">Qutu Seçin!</p>
                                <div class="d-flex flex-row flex-wrap w-100 mx-0">
                                    <div class="col-md-3 col-6 px-1">
                                        <div class="form-check-inline mx-0">
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <img src="https://stroizakaz.su/thumb/2/_tjXSrjgEr6zUQQcol2bpQ/1024r/d/ts-rf-135725331.jpg" alt="black large" class="img-fluid rounded" style="object-fit: contain;">
                                                <span class="text-capitalize font-butler w-100 text-center mt-2 text-theme h6">black large</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 px-1">
                                        <div class="form-check-inline mx-0">
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <img src="https://stroizakaz.su/thumb/2/_tjXSrjgEr6zUQQcol2bpQ/1024r/d/ts-rf-135725331.jpg" alt="cream large" class="img-fluid rounded" style="object-fit: contain;">
                                                <span class="text-capitalize font-butler w-100 text-center mt-2 text-theme h6">cream large</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 px-1">
                                        <div class="form-check-inline mx-0">
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <img src="https://stroizakaz.su/thumb/2/_tjXSrjgEr6zUQQcol2bpQ/1024r/d/ts-rf-135725331.jpg" alt="white large" class="img-fluid rounded" style="object-fit: contain;">
                                                <span class="text-capitalize font-butler w-100 text-center mt-2 text-theme h6">white large</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-3 mt-3">
                                    <p data-v-11909900="" class="font-avenir-black text-theme-secondary text-left" style="color: #898989; font-size: 14px;">Qutu üzərinə yazı yazın</p>
                                    <textarea class="customizing-text-input-fonts"></textarea>
                                    <p data-v-11909900="" class="font-avenir-black text-theme-secondary text-left" style="color: #898989; font-size: 14px; font-weight: 600">Font Seçin</p>
                                    <div class="button-group-customizing-fonts" data-box-index="">
                                        <button class="font-button-customizing-edit" data-font="Playwrite AU SA" style="font-family: Playwrite AU SA">Font A</button>
                                        <button class="font-button-customizing-edit" data-font="Josefin Sans" style="font-family: Josefin Sans;">Font B</button>
                                        <button class="font-button-customizing-edit" data-font="Indie Flower" style="font-family: Indie Flower;">Font C</button>
                                    </div>
                                </div>
                                <p data-v-11909900="" class="font-avenir-black text-theme-secondary text-left ps-3 pt-3" style="color: #898989; font-size: 14px; font-weight: 600">Kart Seçin!</p>
                                <div class="slider-container">
                                    <div class="d-flex row px-3 mb-3">
                                        <div class="col-6 px-1 col-md-6 mb-3">
                                            <img
                                                alt="CONGRATS"
                                                src="https://avatars.mds.yandex.net/i?id=58d014271b1e99f9444554a8931bfaa1_l-6917174-images-thumbs&n=13"
                                                class="rounded img-fluid w-100"
                                                style="min-height: 80px; height: auto; object-fit: contain;"
                                            >
                                        </div>
                                        <div class="col-6 px-1 col-md-6 mb-3">
                                            <img
                                                alt="CONGRATS"
                                                src="https://avatars.mds.yandex.net/i?id=58d014271b1e99f9444554a8931bfaa1_l-6917174-images-thumbs&n=13"
                                                class="rounded img-fluid w-100"
                                                style="min-height: 80px; height: auto; object-fit: contain;"
                                            >
                                        </div>
                                        <div class="col-6 px-1 col-md-6 mb-3">
                                            <img
                                                alt="CONGRATS"
                                                src="https://avatars.mds.yandex.net/i?id=58d014271b1e99f9444554a8931bfaa1_l-6917174-images-thumbs&n=13"
                                                class="rounded img-fluid w-100"
                                                style="min-height: 80px; height: auto; object-fit: contain;"
                                            >
                                        </div>
                                        <div class="col-6 px-1 col-md-6 mb-3">
                                            <img
                                                alt="CONGRATS"
                                                src="https://avatars.mds.yandex.net/i?id=58d014271b1e99f9444554a8931bfaa1_l-6917174-images-thumbs&n=13"
                                                class="rounded img-fluid w-100"
                                                style="min-height: 80px; height: auto; object-fit: contain;"
                                            >
                                        </div>
                                        <div class="col-6 px-1 col-md-6 mb-3">
                                            <img
                                                alt="CONGRATS"
                                                src="https://avatars.mds.yandex.net/i?id=58d014271b1e99f9444554a8931bfaa1_l-6917174-images-thumbs&n=13"
                                                class="rounded img-fluid w-100"
                                                style="min-height: 80px; height: auto; object-fit: contain;"
                                            >
                                        </div>
                                        <div class="col-6 px-1 col-md-6 mb-3">
                                            <img
                                                alt="CONGRATS"
                                                src="https://avatars.mds.yandex.net/i?id=58d014271b1e99f9444554a8931bfaa1_l-6917174-images-thumbs&n=13"
                                                class="rounded img-fluid w-100"
                                                style="min-height: 80px; height: auto; object-fit: contain;"
                                            >
                                        </div>
                                        <div class="col-6 px-1 col-md-6 mb-3">
                                            <img
                                                alt="CONGRATS"
                                                src="https://avatars.mds.yandex.net/i?id=58d014271b1e99f9444554a8931bfaa1_l-6917174-images-thumbs&n=13"
                                                class="rounded img-fluid w-100"
                                                style="min-height: 80px; height: auto; object-fit: contain;"
                                            >
                                        </div>
                                        <div class="col-6 px-1 col-md-6 mb-3">
                                            <img
                                                alt="CONGRATS"
                                                src="https://avatars.mds.yandex.net/i?id=58d014271b1e99f9444554a8931bfaa1_l-6917174-images-thumbs&n=13"
                                                class="rounded img-fluid w-100"
                                                style="min-height: 80px; height: auto; object-fit: contain;"
                                            >
                                        </div>
                                        <div class="col-6 px-1 col-md-6 mb-3">
                                            <img
                                                alt="CONGRATS"
                                                src="https://avatars.mds.yandex.net/i?id=58d014271b1e99f9444554a8931bfaa1_l-6917174-images-thumbs&n=13"
                                                class="rounded img-fluid w-100"
                                                style="min-height: 80px; height: auto; object-fit: contain;"
                                            >
                                        </div>
                                        <div class="col-6 px-1 col-md-6 mb-3">
                                            <img
                                                alt="CONGRATS"
                                                src="https://avatars.mds.yandex.net/i?id=58d014271b1e99f9444554a8931bfaa1_l-6917174-images-thumbs&n=13"
                                                class="rounded img-fluid w-100"
                                                style="min-height: 80px; height: auto; object-fit: contain;"
                                            >
                                        </div>

                                    </div>

                                    <!-- Prev düyməsi -->
                                    <button class="nav-button prev position-absolute d-flex justify-content-center align-items-center">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <!-- Next düyməsi -->
                                    <button class="nav-button next position-absolute d-flex justify-content-center align-items-center">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Sağ tərəf: Məhsullar -->
                            <div class="col-md-6" style="background-color: #6b7280">
                                Sağ tərəf
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .button-group-customizing-fonts {
        display: flex;
        text-align: left;
        margin: 0;
        padding: 0;
    }

    .font-button-customizing-edit {
        float: left;
        clear: left;
        margin-bottom: 5px;
    }

    .slider-container {
        position: relative;
        padding: 0 15px; /* Reduced padding to bring buttons closer */
    }

    .nav-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #333;
        cursor: pointer;
        z-index: 2;
    }

    .nav-button.prev {
        left: 0px; /* Moved closer to content */
    }

    .nav-button.next {
        right: 0px; /* Moved closer to content */
    }

    /* Add transition styles for smooth animation */
    .col-6 {
        transition: all 0.5s ease-in-out;
        opacity: 1;
    }

    .col-6.hiding {
        opacity: 0;
        transform: translateX(-20px);
    }

    .col-6.showing {
        opacity: 1;
        transform: translateX(0);
    }
    .col-6 {
        transition: opacity 0.5s ease-in-out;
        opacity: 0;
        display: none;
    }

    .col-6.active {
        opacity: 1;
        display: block;
    }


</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sliderContainer = document.querySelector('.slider-container');
        const row = sliderContainer.querySelector('.row');
        const prevBtn = sliderContainer.querySelector('.prev');
        const nextBtn = sliderContainer.querySelector('.next');

        const items = row.querySelectorAll('.col-6');
        const itemCount = items.length;
        const itemsPerView = 4;
        let currentPosition = 0;
        let isAnimating = false;

        updateSliderView();

        prevBtn.addEventListener('click', () => {
            if (!isAnimating && currentPosition > 0) {
                slideItems('prev');
            }
        });

        nextBtn.addEventListener('click', () => {
            if (!isAnimating && currentPosition + itemsPerView < itemCount) {
                slideItems('next');
            }
        });

        function slideItems(direction) {
            isAnimating = true;

            const start = currentPosition;
            if (direction === 'next') {
                currentPosition += itemsPerView;
            } else if (direction === 'prev') {
                currentPosition -= itemsPerView;
            }

            // Yeni elementləri animasiya ilə göstər
            updateSliderView(() => {
                isAnimating = false; // Animasiya tamamlandıqda aktivliyi yenilə
            });
        }

        function updateSliderView(callback) {
            // Bütün elementləri gizlət
            items.forEach((item, index) => {
                if (index >= currentPosition && index < currentPosition + itemsPerView) {
                    item.style.display = 'block';
                    item.style.opacity = '0'; // Şəffaflıq
                    setTimeout(() => {
                        item.style.transition = 'opacity 0.5s';
                        item.style.opacity = '1';
                    }, 50);
                } else {
                    item.style.display = 'none';
                }
            });

            // Düymə vəziyyətlərini yenilə
            prevBtn.style.display = currentPosition === 0 ? 'none' : 'block';
            nextBtn.style.display = currentPosition + itemsPerView >= itemCount ? 'none' : 'block';

            if (callback) callback();
        }
    });
</script>

