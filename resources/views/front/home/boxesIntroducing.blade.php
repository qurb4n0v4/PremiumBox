<div class="container-fluid py-5 gift-box-section">
    @foreach($boxes as $index => $box)
        <div class="row align-items-stretch mx-0">
            @if($index % 2 == 0)
                <div class="col-md-6 p-0">
                    <img src="{{ asset('storage/' . $box->image) }}" alt="Gift Box" class="img-fluid w-100 h-100">
                </div>
                <div class="text-content col-md-6 d-flex flex-column justify-content-center p-5" style="background-color: {{ $box->color }}; color: #ffffff;">
                    <h4 class="text-uppercase fw-bold">{{ $box->title_small }}</h4>
                    <h1 class="fw-bold">{{ $box->title_large }}</h1>
                    <p class="mt-3">{{ $box->description }}</p>
                    <a href="{{ $box->link }}" class="btn mt-3 text-white" style="border: 1px solid #ffffff; width: 200px;">{{ $box->button_text }}</a>
                </div>
            @else
                <div class="text-content col-md-6 d-flex flex-column justify-content-center p-5" style="background-color: {{ $box->color }}; color: #ffffff;">
                    <h4 class="text-uppercase fw-bold">{{ $box->title_small }}</h4>
                    <h1 class="fw-bold">{{ $box->title_large }}</h1>
                    <p class="mt-3">{{ $box->description }}</p>
                    <a href="{{ $box->link }}" class="btn mt-3 text-white" style="border: 1px solid #ffffff; width: 200px;">{{ $box->button_text }}</a>
                </div>
                <div class="col-md-6 p-0">
                    <img src="{{ asset('storage/' . $box->image) }}" alt="Gift Box" class="img-fluid w-100 h-100">
                </div>
            @endif
        </div>
    @endforeach
</div>
