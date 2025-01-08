@extends('front.layouts.app')
@section('title', __('Hazır Hədiyyə Qutusu Seçin | BOX & TALE'))
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-premade.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/choose-box.css') }}">

@section('content')
    <div class="choose-box-line"></div>

    <div class="choose-box-steps-container">
{{--        @foreach (range(1, 3) as $stepNumber)--}}
{{--            <div class="choose-box-step">--}}
{{--                <div class="choose-box-circle {{ $stepNumber <= $currentStep ? 'completed' : '' }}">{{ $stepNumber }}</div>--}}
{{--                <div class="choose-box-text">--}}
{{--                    <h3>{{ ['Qutu Seçin', 'Fərdiləşdirin', 'Tamamlandı'][$stepNumber - 1] }}</h3>--}}
{{--                    <p>{{ ['Seçdiyiniz qutunu seçin', 'Qutunuzu fərdiləşdirin', 'Sifarişi tamamlayın'][$stepNumber - 1] }}</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
    </div>

    <div class="container my-5 p-5 choose-boxes-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important; border: 1px solid #ccc; width: 70%;">
        <div class="choose-boxes-header text-center" style="line-height: 0.3">
            <h3 class="fw-bold" style="color: #a3907a; margin-bottom: 15px">Qutunuzu fərdiləşdirin</h3>
            <p style="font-size: 14px; color: #898989">Qutunu, Kartı seçin və Məhsulları Fərdiləşdirin.</p>
            <p style="color: #a3907a; font-size: 14px; font-weight: 600">Sifarişi tamamlamaq üçün seçdiyiniz qutunun içərisindəkilərə nəzər yetirin!</p>
        </div>

        Content Here!

    </div>
@endsection
