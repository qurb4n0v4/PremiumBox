@extends('front.layouts.app')

@section('content')
    <div id="carouselGiftSlides" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            {{--            Slide 1--}}
            <div class="carousel-item active">
                <img src="{{ asset('assets/front/img/BDNJHXxUQPv11llTquieK9dhOYBTmXRDTD37SDbA.webp') }}"
                     class="d-block w-100" alt="GiftBox">
                <div class="carousel-caption d-none d-md-block text-end position-absolute top-50 end-10 p-1">
                    <h5>Ön sifariş qəbul olunur,</h5>
                    <h4>Yeni İl Hədiyyəsi</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <button class="new-year-gifts">Kolleksiyaya Bax</button>
                </div>
            </div>
            {{--            Slide 2--}}
            <div class="carousel-item">
                <img src="{{ asset('assets/front/img/NBDOG4ngtl63dIBg0EHheUE4zTosLjqyU5yAYfT4.webp') }}"
                     class="d-block w-100" alt="Gift box">
                <div class="carousel-caption d-none d-md-block text-end position-absolute top-50 end-10 p-1">
                    <h5>Ön sifariş qəbul olunur,</h5>
                    <h4>Yeni İl Hədiyyəsi</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <button class="new-year-gifts" style="background-color: transparent">Kolleksiyaya Bax</button>
                </div>
            </div>
            {{--            Slide 3--}}
            <div class="carousel-item">
                <img src="{{ asset('assets/front/img/OjzUYpdFfaKRTfCvK9LzVdffrSEqWnCtfQkldVtn.webp') }}"
                     class="d-block w-100" alt="Gift box">
                <div class="carousel-caption d-none d-md-block text-end position-absolute top-50 p-1"
                     style="right: 5%; left: auto;">
                    <h5>Ön sifariş qəbul olunur,</h5>
                    <h4>Yeni İl Hədiyyəsi</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <button class="new-year-gifts" style="background-color: transparent">Kolleksiyaya Bax</button>
                </div>
            </div>
            {{--            Slide 4--}}
            <div class="carousel-item">
                <img src="{{ asset('assets/front/img/OjzUYpdFfaKRTfCvK9LzVdffrSEqWnCtfQkldVtn.webp') }}"
                     class="d-block w-100" alt="Gift box">
                <div class="carousel-caption d-none d-md-block text-end position-absolute top-50 p-1"
                     style="right: 5%; left: auto;">
                    <h5>Ön sifariş qəbul olunur,</h5>
                    <h4>Yeni İl Hədiyyəsi</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <button class="new-year-gifts" style="background-color: transparent">Kolleksiyaya Bax</button>
                </div>
            </div>
            {{--            Slide 5--}}
            <div class="carousel-item">
                <img src="{{ asset('assets/front/img/OjzUYpdFfaKRTfCvK9LzVdffrSEqWnCtfQkldVtn.webp') }}"
                     class="d-block w-100" alt="Gift box">
                <div class="carousel-caption d-none d-md-block text-end position-absolute top-50 p-1"
                     style="right: 5%; left: auto;">
                    <h5>Ön sifariş qəbul olunur,</h5>
                    <h4>Yeni İl Hədiyyəsi</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <button class="new-year-gifts" style="background-color: transparent">Kolleksiyaya Bax</button>
                </div>
            </div>
            {{--            Slide 6--}}
            <div class="carousel-item">
                <img src="{{ asset('assets/front/img/OjzUYpdFfaKRTfCvK9LzVdffrSEqWnCtfQkldVtn.webp') }}"
                     class="d-block w-100" alt="Gift box">
                <div class="carousel-caption d-none d-md-block text-end position-absolute top-50 p-1"
                     style="right: 5%; left: auto;">
                    <h5>Ön sifariş qəbul olunur,</h5>
                    <h4>Yeni İl Hədiyyəsi</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <button class="new-year-gifts" style="background-color: transparent">Kolleksiyaya Bax</button>
                </div>
            </div>
            {{--            Slide 7--}}
            <div class="carousel-item">
                <img src="{{ asset('assets/front/img/OjzUYpdFfaKRTfCvK9LzVdffrSEqWnCtfQkldVtn.webp') }}"
                     class="d-block w-100" alt="Gift box">
                <div class="carousel-caption d-none d-md-block text-end position-absolute top-50 p-1"
                     style="right: 5%; left: auto;">
                    <h5>Ön sifariş qəbul olunur,</h5>
                    <h4>Yeni İl Hədiyyəsi</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <button class="new-year-gifts" style="background-color: transparent">Kolleksiyaya Bax</button>
                </div>
            </div>
        </div>
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselGiftSlides" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselGiftSlides" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselGiftSlides" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>
    </div>
@endsection
