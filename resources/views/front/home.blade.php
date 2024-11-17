@extends('front.layouts.app')


{{-- SEO optimizasiya meta teqləri --}}
@section('title', __('Build a Gift Box | BOX & TALE'))
@section('meta_keywords', 'hədiyyə qutusu, unikal hədiyyələr, yaradıcı hədiyyə ideyaları, lüks qutular, xüsusi hədiyyələr')
@section('meta_description', 'Premium hədiyyə qutuları və yaradıcı hədiyyə ideyaları ilə hər xüsusi anı unudulmaz edin. Mükəmməl hədiyyələr üçün doğru ünvan.')
@section('og_title', 'Ana Səhifə - Hədiyyə Qutuları')
@section('og_description', 'Unikal hədiyyə qutuları ilə yaxınlarınıza özəl anlar yaşadın. Bizim premium hədiyyə qutuları fərqlənmək üçün mükəmməl seçimdir.')
@section('og_image', asset('assets/front/img/giftbox.jpg'))
@section('og_url', url()->current())


@section('content')
    @include('front.home.imagesSlider')
    @include('front.home.giftsImages')
    @include('front.home.boxesIntroducing')
    @include('front.home.ourPartners')
    @include('front.home.socialMediaPosts')
@endsection
