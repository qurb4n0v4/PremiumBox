<section class="social-media-posts py-5 mt-5">
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="custom-gift fw-bold">GiftBox tərəfindən Xüsusi Hədiyyə Paketləri</h1>
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
