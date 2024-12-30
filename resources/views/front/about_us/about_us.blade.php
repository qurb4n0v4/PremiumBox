@extends('front.layouts.app')

@section('title', 'About Us | BOX & TALE')

@section('content')
    <div class="custom-about-container my-3">
        <!-- About Us Section -->
        <div class="section-about-us row align-items-center" style="background-color: #ffffff;">
            <div class="col-lg-6 text-center">
                <img src="" alt="GiftBox" class="about-us-image img-fluid">
            </div>
            <div class="col-lg-6">
                <h1 class="about-us-title">GiftBox</h1>
                <p class="about-us-subtitle">by GiftBox</p>
                <p>
                    GiftBox onlayn əsaslı hədiyyə satıcısıdır. Biz burada, müştərilərimizin xüsusi günlərini sevdikləri
                    ilə daha da gözəlləşdirmək üçün hədiyyə qutusu və onun içindəkiləri hazırlamağa kömək edirik.
                    Müştərilərimiz, hədiyyə qutularının içini bizim seçilmiş məhsul kolleksiyamızdan seçə bilərlər.

                </p>
                <p>
                    Biz inanırıq ki, hər bir müştərimizin yaxın insanları ilə özünəməxsus və xüsusi münasibətləri var,
                    buna görə də müştərilərimizə onların şəxsi toxunuşlarını hədiyyələrimizə qatmağa imkan veririk. Bu
                    hədiyyə qutuları unikal və hər alıcıya uyğun şəkildə tərtib olunur, müştərilərimizin xüsusi
                    ehtiyaclarını təmsil edir.

                </p>
                <p>
                    Biz həmçinin müştərilərimizə rahat hədiyyə alış-verişi təklif etməyi hədəfləyirik. Müştərilərimiz
                    sadəcə veb saytımızda bir neçə klik edərək hədiyyə alış-verişini tamamlayacaq və biz qalan hər şeyi
                    edəcəyik!

                </p>
            </div>
        </div>

        <!-- How It Works Section -->
        <div class="how-it-works-section row">
            <h2 class="text-center how-it-works-title">Proses Necə İşləyir?</h2>
            <div class="d-flex flex-wrap justify-content-center align-items-center how-it-works-steps">
                <div class="how-it-works-step">
                    <p>Qutu Hazırlayın və ya Hazır Qutuları Seçin</p>
                </div>
                <div class="how-it-works-arrow">
                    <span></span>
                </div>
                <div class="how-it-works-step">
                    <p>Sifarişi Verin və Ödənişi Tamamlayın</p>
                </div>
                <div class="how-it-works-arrow">
                    <span></span>
                </div>
                <div class="how-it-works-step">
                    <p>2-5 Istehsal</p>
                </div>
                <div class="how-it-works-arrow">
                    <span></span>
                </div>
                <div class="how-it-works-step">
                    <p>Kuryer ilə Çatdırılacaq</p>
                </div>
            </div>
        </div>

        <div class="shall-we-begin-section row">
            <div class="row align-items-center">
                <!-- Left Content -->
                <div class="col-lg-6 text-center mb-4 mb-md-0">
                    <h2 class="shall-we-begin-title">Başlayaq?</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <h4 class="step-title">Öz Şəxsi Hədiyyənizi Yaradın</h4>
                            <button class="btn  btn-shall-we">Qutu Yaradın</button>
                        </li>
                        <li class="mb-3">
                            <h4 class="step-title">Hazır Hədiyyə Paketlərini Alın</h4>
                            <button class="btn  btn-shall-we">Hazır Qutu</button>
                        </li>
                        <li class="mb-3">
                            <h4 class="step-title">Korporativ Hədiyyələr və Xüsusi Layihələr</h4>
                            <button class="btn  btn-shall-we">Korporativ Hədiyyələr</button>
                        </li>
                    </ul>
                    <p class="mt-3 additional-info p-2">
                        Əlavə məlumat üçün, <a href="#" class="text-decoration-none" style="color: #a3907a;">Bizimlə Əlaqə Saxlayın</a> və ya
                        <a href="#" class="text-decoration-none" style="color: #a3907a;">GiftBox's FAQ</a> səhifəsinə baxın
                    </p>
                    </p>
                </div>
                <!-- Right Image -->
                <div class="col-lg-6 text-center">
                    <img src="gift-box.jpg" alt="Gift Boxes" class="img-fluid rounded shall-we-begin-image">
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .custom-about-container {
        max-width: 1200px !important;
        margin: 0 auto;
        padding: 0 15px;
    }

    .section-about-us,
    .how-it-works-section,
    .shall-we-begin-section {
        width: 100%;
        padding: 3rem 0;
        border-radius: 8px;
    }

    .section-about-us {
        padding: 3rem 0;
        border-top-right-radius: 20px;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .about-us-title {
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #a3907a ;
    }

    .about-us-subtitle {
        color: #a3907a;
    }

    .about-us-image {
        max-width: 100%;
        border-radius: 8px;
    }

    .how-it-works-section {
        background-color: #a3907a;
        padding: 2rem 1rem;
        border-radius: 0;
    }

    .how-it-works-title {
        font-size: 1.4rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
        color: #ffffff;
        text-align: center;
    }

    .how-it-works-steps {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #ffffff;
    }

    .how-it-works-step {
        padding-top: 5px;
        background-color: #a3907a;
        border: 1px solid #ffffff;
        border-radius: 20px;
        width: 200px;
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 14px;
        line-height: 1.4;
        color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .how-it-works-arrow {
        position: relative;
        width: 40px;
        height: 1px;
        background-color: #ffffff;
        flex-shrink: 0;
    }

    .how-it-works-arrow span {
        position: absolute;
        top: 50%;
        right: -10px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
        border-left: 10px solid #ffffff;
    }

    @media (max-width: 768px) {
        .how-it-works-steps {
            flex-direction: column;
        }

        .how-it-works-arrow {
            display: none;
        }

        .how-it-works-step {
            width: 100%;
        }
    }

    .shall-we-begin-section {
        background-color: #ffffff;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;

    }

    .shall-we-begin-title {
        font-size: 2.0rem;
        color: #a3907a;
        margin-bottom: 1.5rem;
    }

    .step-title {
        font-size: 1.2rem;
        color: #898989;
        margin-bottom: 0.5rem;
    }

    .btn-shall-we {
        font-size: 0.9rem;
        padding: 0.5rem 1.5rem;
        border: 1px solid #a3907a !important;
        color: #a3907a !important;
        border-radius: 15px !important;
        transition: all 0.3s ease;
    }

    .btn-shall-we:hover {
        background-color: #a3907a !important;
        color: #ffffff !important;
    }

    .additional-info {
        font-size: 0.9rem;
        color: #898989;
    }

    .shall-we-begin-image {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        object-fit: cover;
    }

</style>

