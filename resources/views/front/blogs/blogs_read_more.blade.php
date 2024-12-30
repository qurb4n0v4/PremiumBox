@extends('front.layouts.app')

@section('title', 'Blog Detail | BOX & TALE')

@section('content')
    <div class="container blog-detail">
        <div class="blog-sections-container">
            <h1 class="blog-main-title">{{ $blog->title }}</h1>
        @if(!empty($blogDetails) && is_array($blogDetails))
                @foreach($blogDetails as $section)
                    <div class="blog-section">
                        @if(isset($section['image']) && $section['image'])
                            <img
                                src="{{ asset('storage/' . $section['image']) }}"
                                alt="{{ $section['title'] }}"
                                class="blog-section-image"
                            >
                        @endif

                        <div class="blog-section-content">
                            <h5 class="blog-section-title">{{ $section['title'] }}</h5>
                            <p class="blog-section-description">{{ $section['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Bu blog yazısı üçün heç bir açıqlama mövcud deyil.</p>
            @endif
        </div>
    </div>



    <style>
        .blog-detail {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .blog-main-title {
            font-size: 2.5rem;
            text-align: left;
            margin-bottom: 40px;
            color: #a3907a !important;
        }

        .blog-sections-container {
            display: flex;
            flex-direction: column;
            gap: 5px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 20px;
        }

        .blog-section {
            display: flex;
            flex-direction: column;
            gap: 5px;
            align-items: flex-start;
        }


        .blog-section-image {
            width: 60%;
            height: auto;
            border-radius: 5px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .blog-section-content {
            flex: 1;
        }

        .blog-section-title {
            margin-bottom: 10px;
            color: #333;
        }

        .blog-section-description {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .blog-main-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .blog-main-title {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
