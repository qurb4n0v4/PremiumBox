@extends('front.layouts.app')

@section('title', 'Blog Detail | BOX & TALE')

@section('content')
    <div class="container blog-detail">
        <h1 class="blog-main-title">{{ $blog->title }}</h1>
        <p class="blog-paragraph">{{ $blog->paragraph }}</p>

{{--        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-image">--}}

        <div class="blog-sections-container">
            @foreach($blog->blogDetails as $section)
                <div class="blog-section">
                    @if($section->image)
                        <img
                            src="{{ asset('storage/' . $section->image) }}"
                            alt="{{ $section->title }}"
                            class="blog-section-image"
                        >
                    @endif

                    <div class="blog-section-content">
                        <h2 class="blog-section-title">{{ $section->title }}</h2>
                        <p class="blog-section-description">{{ $section->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
