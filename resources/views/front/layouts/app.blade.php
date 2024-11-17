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
    <meta name="keywords" content="@yield('meta_keywords','hədiyyə qutusu, unikal hədiyyələr, yaradıcı hədiyyə ideyaları, lüks qutular')">
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
<body>
@include('front.partials.navbar')

<div class="scroll-container">
    <main>
        @yield('content')
    </main>
</div>

@include('front.partials.footer')

<script src="{{ asset('assets/front/js/script.js') }}"></script>

@vite(['resources/js/app.js'])
</body>
</html>
