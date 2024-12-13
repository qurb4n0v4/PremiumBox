@extends('front.layouts.app')

@section('title', 'FAQ | BOX & TALE')

@section('content')
    <div class="faq-page">
        <div class="faq-container">
            <h1>Frequently Asked Questions</h1>
            <ul class="faq-list">
                @foreach ($faqs as $faq)
                    <li class="faq-item">
                        <div class="question">
                            <strong>{{ $faq->question }}</strong>
                            <div class="icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="animated-line"></div>
                        <div class="answer">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
