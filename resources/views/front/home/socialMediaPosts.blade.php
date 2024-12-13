<section class="social-media-posts py-5 mt-5">
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="custom-gift fw-bold">Custom Gift Hampers by GiftBox</h1>
        </div>

        <div class="gallery">
            <!-- Media Item 1 -->
            <div class="gallery-item">
                <img src="{{ asset('assets/front/img/header.webp') }}" alt="Calendar" class="gallery-media">
            </div>
            <!-- Media Item 2 -->
            <div class="gallery-item">
                <img src="{{ asset('assets/front/img/red.webp') }}" alt="Gift Set" class="gallery-media">
            </div>
            <!-- Media Item 3 -->
            <div class="gallery-item">
                <img src="{{ asset('assets/front/img/violet.webp') }}" alt="Christmas Tree" class="gallery-media">
            </div>
            <!-- Media Item 4 -->
            <div class="gallery-item">
                <video controls class="gallery-media">
                    <source src="{{ asset('assets/front/video/giftbox.mp4') }}" type="video/mp4">
                    Your browser does not support this video.
                </video>
            </div>
            <!-- Media Item 5 -->
            <div class="gallery-item">
                <img src="{{ asset('assets/front/img/yellow.webp') }}" alt="Gift Box" class="gallery-media">
            </div>
            <!-- Media Item 6 -->
            <div class="gallery-item">
                <video controls class="gallery-media">
                    <source src="{{ asset('assets/front/video/giftbox.mp4') }}" type="video/mp4">
                    Your browser does not support this video.
                </video>
            </div>
        </div>
    </div>
</section>

<style>
    /* Galeri Alanı */
    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 10px;
        margin: 0 auto;
    }

    /* Her Galeri Öğesi */
    .gallery-item {
        position: relative;
        background: #fff;
        /*border-radius: 10px;*/
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /*.gallery-item:hover {*/
    /*    transform: scale(1.05);*/
    /*    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);*/
    /*}*/

    /* Resim ve Video Stili */
    .gallery-media {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Başlık ve Metin */
    .custom-gift {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 1rem;
        font-family: 'Poppins', sans-serif;
    }

    @media (max-width: 576px) {
        .gallery {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
    }
</style>
