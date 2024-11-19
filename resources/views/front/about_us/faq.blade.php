@extends('front.layouts.app')

@section('title', 'FAQ | BOX & TALE')

@section('content')

<div class="faq-main">
    <div class="faq-box">
        <div class="faq-right">
        <div class="faq-section">
        <h1>Tez-tez verilən suallar</h1>

        <div class="faq-item">
            <div class="faq-question">S: Box & Tale hədiyyə qutularının ölçüləri nə qədərdir?</div>
            <div class="faq-answer">C: Standart qutu (21x25x10sm) və Böyük qutu (25x30x12sm).</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: "Qutu Yarat" və "Hazır Qutu" arasında fərq nədir?</div>
            <div class="faq-answer">C: "Qutu Yarat" müştərinin qutunu, hədiyyələri və kartı öz zövqünə görə yaratmasına imkan verir. "Hazır Qutu" isə nə hədiyyə alacağınıza qərar verə bilmədikdə və ya ideyaya ehtiyacınız olduqda istifadə edilə bilər.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Hədiyyənin qiyməti nə qədərdir?</div>
            <div class="faq-answer">C: Qiymət qutuya əlavə etdiyiniz əşyalara və ya seçdiyiniz hazır paketin növünə görə dəyişir, buna görə büdcənizə uyğunlaşdıra bilərsiniz.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Bir qutuya neçə əşya yerləşə bilər?</div>
            <div class="faq-answer">C: Qutunun məzmununu müştəri müəyyən edir, buna görə də əşyaların sayı dəyişir. Qutunun dolduğu barədə bildiriş alacaqsınız.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Sadəcə qutunu sifariş edə bilərəmmi və onun daxilində nələr var?</div>
            <div class="faq-answer">C: Əlbəttə, yalnız qutunu sifariş edə bilərsiniz. Onun daxilində hədiyyə kartı, lent, kağız parçaları və salfet kağızı var.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Qutudan başqa yalnız hədiyyə əşyalarını sifariş edə bilərəmmi?</div>
            <div class="faq-answer">C: Hər bir sifarişə qutu daxil edilməlidir.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Qutunun hazırlanması nə qədər vaxt alır?</div>
            <div class="faq-answer">C: Sifarişdən çatdırılmaya qədər bütün proses 2-7 gün çəkir. Personalizasiya səviyyəsinə görə bu müddət uzana bilər.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Qutunun çatdırılma vaxtını necə hesablaya bilərəm?</div>
            <div class="faq-answer">C: Müştərilər çatdırılma vaxtını sifariş formasında təyin edə bilərlər. Box & Tale sifarişi göstərilən tarixdə göndərəcək (xahiş edirik, gözlənilməz gecikmələr üçün əlavə vaxt nəzərə alın).</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Box & Tale hansı çatdırılma xidmətlərini təklif edir?</div>
            <div class="faq-answer">C: Box & Tale JNE (bütün İndoneziya ərazisini əhatə edir) və GoSend (Jabodetabek ərazisi üçün) kimi kuryer xidmətlərindən istifadə edir.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Hədiyyəni digər şəhərlərə çatdırmaq mümkündürmü?</div>
            <div class="faq-answer">C: Box & Tale İndoneziya daxilində bütün ərazilərə çatdırılma edir.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Beynəlxalq çatdırılma mövcuddurmu?</div>
            <div class="faq-answer">C: Hal-hazırda Box & Tale yalnız İndoneziya daxilində çatdırılma edir. Lakin, xaricdə yaşayan müştərilər üçün dəstək göstərə bilərik.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Hədiyyəni birbaşa alıcıya göndərmək mümkündürmü?</div>
            <div class="faq-answer">C: Əlbəttə! Çatdırılma ünvanına alıcının məlumatlarını daxil edin və biz onu birbaşa onlara göndərərik!</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Xüsusi tələblərim olarsa nə etməliyəm?</div>
            <div class="faq-answer">C: Çatdırılma tarixi və ya qutu məzmunu ilə bağlı xüsusi tələblərinizi sifariş zamanı qeyd sahəsinə yaza bilərsiniz və ya bizimlə WhatsApp və Line vasitəsilə əlaqə saxlayın.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Hansı ödəniş üsulları mövcuddur?</div>
            <div class="faq-answer">C: Kredit kartı, bank köçürməsi, Gopay, Ovo, Shopeepay və s. ödəniş üsullarını qəbul edirik. Xarici ödənişlər üçün PayPal da mövcuddur.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Qutu çatdırılma zamanı zədələnsə nə etməliyəm?</div>
            <div class="faq-answer">C: Göndərilmədən əvvəl qutunun şəklini sizə təqdim edirik. Zərər olarsa, məhsulları şəkilə əsasən yenidən düzəldə bilərsiniz.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Sifarişlə bağlı problem olarsa nə etməliyəm?</div>
            <div class="faq-answer">C: Problem yaranarsa, dərhal bizimlə əlaqə saxlayın.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Korporativ hədiyyələr üçün xidmət təklif olunurmu?</div>
            <div class="faq-answer">C: Bəli, Box & Tale böyük partiyalar üçün korporativ hədiyyələr və xüsusi layihələr təklif edir.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Korporativ hədiyyələr üçün haradan sifariş edə bilərəm?</div>
            <div class="faq-answer">C: WhatsApp (0818 1818 4158) vasitəsilə bizimlə əlaqə saxlayın, komandamız sizə kömək edəcək.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">S: Digər suallarım olarsa nə etməliyəm?</div>
            <div class="faq-answer">C: WhatsApp (081311033691) və Line (@boxandtale) vasitəsilə bizimlə əlaqə saxlayın.</div>
        </div>
    </div>
        </div>

    </div>
</div>

<style>
        .faq-main{
        width: 100%;
        height: auto;
        background-color: rgb(248,248,248);
        display: flex;
        justify-content: center;
    }
    .faq-box {
        margin-top: 24px;
        margin-bottom: 24px;
        width: 1100px;
        border-radius: 10px;
        height: auto;
        background-color: white;
        display: flex;
        justify-content: space-between;
        padding: 40px 25px;

    }
    .faq-section {
            max-width: 800px;
            margin: auto;
        }
        .faq-item {
            margin-bottom: 20px;
        }
        .faq-question {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .faq-answer {
            margin-left: 20px;
        }


</style>

@endsection
