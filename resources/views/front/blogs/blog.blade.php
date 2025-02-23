@extends('front.layouts.app')
@section('content')
    <div class="container my-5 p-5 blogs-page" style="border-radius: 20px; background-color: #ffffff; max-width: 1150px!important;">
        <div class="gift-blogs text-left">
            <h2 class="fw-bold" style="color: #a3907a">Blog</h2>
        </div>
        <div class="row gy-4 mt-2">
            @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-3">
                    <div class="card blog-card h-100">
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
                        <div class="blog-content">
                            <h5 class="blog-title">{{ $blog->title }}</h5>
                            <p class="blog-text">{{ $blog->paragraph }}</p>
                            <a href="{{ route('blog.show', $blog->id) }}" class="read-more-for-blogs read-more-btn">Daha Çox...</a>                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
@endsection


<style>
    @media (max-width: 1200px) {
        .blogs-page .row {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 992px) { /* Tablet ölçüləri üçün */
        .col-lg-3 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 768px) { /* Mobil ölçüləri üçün */
        .col-lg-3,
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .blog-card {
            width: 100%; /* Tam genişlikdə olsun */
            margin: 0 auto; /* Ortaya gətir */
        }
    }


</style>
