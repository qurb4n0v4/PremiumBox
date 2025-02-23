<section class="social-media-posts py-5 mt-5">
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="custom-gift fw-bold">Sosial Media hesablarımızı izləyərək yeniliklərdən xəbərdar olun!</h1>
        </div>

        <div class="gallery">
            @foreach($mediaItems as $mediaItem)
                <div class="gallery-item">
                    @if($mediaItem->media_type == 'image')
                        <img src="{{ asset('storage/' . $mediaItem->media_path) }}" alt="{{ $mediaItem->media_type }}" class="gallery-media">
                    @elseif($mediaItem->media_type == 'video')
                        <video controls class="gallery-media">
                            <source src="{{ asset('storage/' . $mediaItem->media_path) }}" type="video/mp4">
                            Brauzeriniz bu videonu dəstəkləmir.
                        </video>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    @media (max-width: 992px) {
        .social-media-posts .custom-gift {
            font-size: 28px;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Mərkəzə hizalama */
            gap: 15px; /* Şəkillər və videolar arasında boşluq */
        }

        .gallery-item {
            display: flex;
            justify-content: center; /* İçindəki şəkil və videonu mərkəzə gətirir */
            align-items: center;
            width: 100%; /* Tam eni tutsun */
        }

        .gallery-media {
            max-width: 100%;
            height: auto;
            display: block;
        }
    }

    @media (max-width: 768px) {
        .social-media-posts .custom-gift {
            font-size: 24px;
        }

        .gallery {
            gap: 10px;
        }
    }

    @media (max-width: 576px) {
        .social-media-posts .custom-gift {
            font-size: 20px;
            line-height: 1.4;
        }

        .gallery {
            flex-direction: column; /* Kiçik ekranlarda alt-alta düşsün */
            align-items: center; /* Tam mərkəzlənsin */
        }

        .gallery-item {
            width: 100%; /* Tam eni tutsun */
        }

        .gallery-media {
            max-width: 90%; /* Ekranın 90%-ni tutsun, sağ-sol balanslı olsun */
        }
    }

</style>
