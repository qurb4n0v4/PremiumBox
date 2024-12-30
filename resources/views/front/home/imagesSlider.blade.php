<div id="carouselGiftSlides" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($slides as $index => $slide)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $slide->image) }}" class="d-block w-100" alt="GiftBox">
                <div class="carousel-caption d-none d-md-block text-end position-absolute top-50 end-10 p-1">
                    @if($slide->title_small)
                        <h5>{{ $slide->title_small }}</h5>
                    @endif
                    <h4>{{ $slide->title_large }}</h4>
                    @if($slide->description)
                        <p>{{ $slide->description }}</p>
                    @endif
                    <button class="new-year-gifts" style="background-color: transparent">
                        {{ $slide->button_text }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="carousel-indicators">
        @foreach($slides as $index => $slide)
            <button type="button" data-bs-target="#carouselGiftSlides" data-bs-slide-to="{{ $index }}"
                    class="{{ $index == 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
</div>
