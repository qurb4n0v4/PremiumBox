<div class="container-fluid gift-box-section">
    <div class="row align-items-stretch">
        <div class="col-md-6 p-0 img-container">
            <img src="{{ asset('assets/front/img/violet.webp') }}" alt="Gift Box" class="img-fluid">
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center content-container" style="background-color: #d8d1db; color: #ffffff;">
            <h4 class="text-uppercase fw-bold">Öz Hədiyyə Qutunuzu Yaradın</h4>
            <h1 class="fw-bold">İstəyə uyğun yığılmış hədiyyə qutusu</h1>
            <p class="mt-3">Hədiyyələrinizi özəl günlərinizə uyğun fərdiləşdirin – qutudan məhsullara, kartlara qədər!</p>
            <p>Doğum günləri, ildönümləri, məzuniyyətlər, Sevgililər Günü, Ana Günü, Ata Günü və daha çoxu üçün.</p>
            <p>PremiumBox sizin üçün hər şeyi düşündü!</p>
            <a href="{{ route('choose_a_box') }}" class="btn mt-3 text-white" style="border: 1px solid #ffffff; width: 200px;">QUTUNU YARAT</a>
        </div>
    </div>

    <div class="row align-items-stretch">
        <div class="col-md-6 p-0 img-container order-md-1 order-1">
            <img src="{{ asset('assets/front/img/giftbox.jpg') }}" alt="Gift Box" class="img-fluid">
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center content-container order-md-2 order-2" style="background-color: #e8bc6c; color: #ffffff;">
            <h4 class="text-uppercase fw-bold">İlham Ehtiyacınız Var?</h4>
            <h1 class="fw-bold">Hazır Qutu</h1>
            <p class="mt-3">Əgər seçim etməkdə çətinlik çəkirsinizsə, hazır qutularımızdan birini seçin.</p>
            <p>PremiumBox müxtəlif hədiyyə paketləri hazırlayıb – fərqli tədbirlər, maraqlar və rənglərə uyğun!</p>
            <a href="{{ route('choose_premade_box') }}" class="btn mt-3 text-white" style="border: 1px solid #ffffff; width: 200px;">HAZIR QUTU</a>
        </div>
    </div>

    <div class="row align-items-stretch">
        <div class="col-md-6 p-0 img-container order-md-1 order-1">
            <img src="{{ asset('assets/front/img/corporate1.webp') }}" alt="Gift Box" class="img-fluid">
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center content-container order-md-2 order-2" style="background-color: #aa5162; color: #ffffff;">
            <h4 class="text-uppercase fw-bold">Böyük Sayda Hədiyyə Lazımdır?</h4>
            <h1 class="fw-bold">Korporativ Hədiyyələr & Xüsusi Layihələr</h1>
            <p class="mt-3">PremiumBox xüsusi anlarınızı qeyd etməyə kömək edir – istər kiçik, istərsə də BÖYÜK!</p>
            <a href="{{ route('corporate-gifts') }}" class="btn mt-3 text-white" style="border: 1px solid #ffffff; width: 200px;">KORPORATİV HƏDİYYƏLƏR</a>
        </div>
    </div>
</div>

<style>
    .gift-box-section {
        overflow-x: hidden;
    }

    .gift-box-section .row {
        margin: 0;
    }

    .gift-box-section .img-container {
        height: 600px;
        position: relative;
    }

    .gift-box-section .img-container img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        left: 0;
        top: 0;
    }

    .gift-box-section .content-container {
        min-height: 600px;
        padding: 40px;
    }

    .gift-box-section h4 {
        font-size: 18px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .gift-box-section h1 {
        font-size: 36px;
    }

    .gift-box-section .btn {
        max-width: 200px;
    }

    @media (max-width: 768px) {
        .gift-box-section .img-container {
            height: 450px;
        }


        .gift-box-section .content-container {
            min-height: auto;
            padding: 30px 20px;
            text-align: center;
        }

        .gift-box-section h4 {
            font-size: 16px;
        }

        .gift-box-section h1 {
            font-size: 24px;
        }

        .gift-box-section p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .gift-box-section .btn {
            margin: 15px auto;
            font-size: 14px;
            display: block;
        }
    }
</style>
