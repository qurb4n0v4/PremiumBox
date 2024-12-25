<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Build a Gift Box | BOX & TALE')</title>

    @vite(['resources/css/app.css'])

    {{-- SEO meta tags --}}
    <meta name="keywords"
          content="@yield('meta_keywords','hədiyyə qutusu, unikal hədiyyələr, yaradıcı hədiyyə ideyaları, lüks qutular,')">
    <meta name="description"
          content="@yield('meta_description', 'Premium hədiyyə qutuları və unikal hədiyyə ideyaları - hər xüsusi an üçün mükəmməl seçim.')">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="@yield('og_title', 'Premium Hədiyyə Qutuları')">
    <meta property="og:description"
          content="@yield('og_description', 'Unikal və yaradıcı hədiyyə ideyaları ilə fərqlənən lüks hədiyyə qutuları.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/front/img/giftbox.jpg'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">

    {{-- Robots --}}
    <meta name="robots" content="index, follow">

    {{--    Favicon    --}}
    <link rel="icon" href="{{ asset('assets/front/img/giftbox.jpg') }}" type="image/x-icon">

    {{--    CSS     --}}
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">

    {{--    Bootstrap   --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{--swiper cdn--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">


    {{--    Font Family    --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">


    {{--    Font Awasome    --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Product",
          "name": "Unikal Hədiyyə Qutuları",
          "description": "Yaradıcı və fərqli hədiyyələr üçün yüksək keyfiyyətli hədiyyə qutuları. Hər xüsusi an üçün mükəmməl seçim.",
          "image": "{{ asset('assets/front/img/giftbox.jpg') }}", <!-- Buraya layihənizin əsas şəkil linkini əlavə edin -->
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Fəvvarələr Meydanı 12",
    "addressLocality": "Bakı",
    "addressRegion": "AZ",
    "postalCode": "1000",
    "addressCountry": "Azərbaycan"
  },
  "telephone": "+994123456789",
  "priceRange": "$$",
  "brand": {
    "@type": "Brand",
    "name": "GiftBox Company"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "AZN",
    "price": "50.00",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "https://schema.org/InStock",
    "url": "{{ url()->current() }}"
  }
}
    </script>

</head>
<body class="{{ Request::is('/') ? 'home' : '' }}">
@include('front.partials.navbar')

<div class="scroll-container">
    <main>
        @yield('content')
    </main>
</div>
@include('front.partials.chat-button')

@include('front.partials.footer')


<script src="https://cdn.jsdelivr.net/npm/heroicons@1.0.6/dist/heroicons.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

<script src="{{ asset('assets/front/js/script.js') }}"></script>

@vite(['resources/js/app.js'])
</body>
</html>
