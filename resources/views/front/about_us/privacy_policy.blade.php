@extends('front.layouts.app')

@section('title', 'Privacy Policy | BOX & TALE')

@section('content')

<div class="privacy-main">
    <div class="privacy-box">
        <div class="privacy-right">
        <h1>Məxfilik Siyasəti</h1>
    <p><strong>Effektiv tarix:</strong> 12 Avqust 2020</p>

    <h2>Giriş</h2>
    <p>Box & Tale-ə xoş gəlmisiniz.</p>
    <p>Box & Tale (“biz”, “bizi” və ya “bizim”) www.boxandtale.com veb saytını (“Xidmət”) idarə edir.</p>
    <p>Məxfilik Siyasətimiz www.boxandtale.com ziyarətlərinizi tənzimləyir və Xidmətimizdən istifadə nəticəsində məlumatları necə topladığımızı, qoruduğumuzu və açıqladığımızı izah edir.</p>
    <p>Məlumatlarınızı Xidmət təqdim etmək və onu təkmilləşdirmək üçün istifadə edirik. Xidmətdən istifadə etməklə bu siyasətə uyğun olaraq məlumatların toplanmasına və istifadəsinə razılıq vermiş olursunuz. Bu Məxfilik Siyasətində başqa cür göstərilmədikcə, burada istifadə olunan terminlər bizim Şərtlər və Qaydalarımızda təyin olunan mənaları daşıyır.</p>
    <p>Şərtlər və Qaydalarımız (“Şərtlər”) Xidmətimizin bütün istifadəsini tənzimləyir və Məxfilik Siyasəti ilə birlikdə sizinlə bizim aramızda razılaşmanı (“razılaşma”) təşkil edir.</p>

    <h2>Təriflər</h2>
    <p><strong>XİDMƏT:</strong> Box & Tale tərəfindən idarə olunan www.boxandtale.com veb saytını nəzərdə tutur.</p>
    <p><strong>ŞƏXSİ MƏLUMATLAR:</strong> fərdi müəyyən edən məlumatlardır (bizim sahib olduğumuz və ya əldə edə biləcəyimiz digər məlumatlarla birlikdə fərdi müəyyən etmək üçün istifadə edilə bilən məlumatlar).</p>
    <p><strong>İSTİFADƏ MƏLUMATLARI:</strong> avtomatik olaraq toplanan məlumatlardır (məsələn, səhifədə qalma müddəti kimi).</p>
    <p><strong>COOKİE:</strong> cihazınızda (kompüter və ya mobil cihazda) saxlanılan kiçik fayllardır.</p>
    <p><strong>MƏLUMAT NƏZARƏTÇİSİ:</strong> şəxsi məlumatların işlənməsi məqsədini və üsulunu müəyyən edən fiziki və ya hüquqi şəxsdir. Bu Məxfilik Siyasəti məqsədilə, biz sizin məlumatlarınızın Məlumat Nəzarətçisiyik.</p>
    <p><strong>MƏLUMAT EMALÇILARI (VƏ YA XİDMƏT TƏCHİZATÇILARI):</strong> məlumatları Məlumat Nəzarətçisi adından işləyən hər hansı fiziki və ya hüquqi şəxsdir. Məlumatlarınızı daha effektiv şəkildə emal etmək üçün müxtəlif Xidmət Təchizatçılarının xidmətlərindən istifadə edə bilərik.</p>
    <p><strong>MƏLUMAT SUBYEKTI:</strong> Şəxsi Məlumatların mövzusunu təşkil edən hər hansı canlı fərddir.</p>
    <p><strong>İSTİFADƏÇİ:</strong> bizim Xidmətimizdən istifadə edən fərdi şəxsdir. İstifadəçi Məlumat Subyektinə uyğun gəlir və Şəxsi Məlumatların mövzusunu təşkil edir.</p>

    <h2>Məlumatların Toplanması və İstifadəsi</h2>
    <p>Biz, Xidmətimizi təqdim etmək və təkmilləşdirmək məqsədilə müxtəlif növ məlumatları toplayırıq.</p>

    <h2>Toplanan Məlumat Növləri</h2>
    <h3>Şəxsi Məlumatlar</h3>
    <p>Xidmətimizdən istifadə edərkən, sizinlə əlaqə yaratmaq və sizi müəyyən etmək üçün istifadə edilə bilən bəzi şəxsi məlumatlarınızı təqdim etməyinizi istəyə bilərik (“Şəxsi Məlumatlar”). Şəxsi Məlumatlara aşağıdakılar daxildir:</p>
    <ul>
        <li>Email ünvanı</li>
        <li>Ad və soyad</li>
        <li>Telefon nömrəsi</li>
        <li>Ünvan, Ölkə, Ştat, Rayon, Poçt indeksi, Şəhər</li>
        <li>Cookie-lər və İstifadə Məlumatları</li>
    </ul>
    <p>Biz Şəxsi Məlumatlarınızı sizə xəbər bülletenləri, marketinq və ya promosyon materialları və maraq doğura biləcək digər məlumatları göndərmək üçün istifadə edə bilərik. Bu cür əlaqələrdən imtina etmək üçün “unsubscribe” keçidinə keçə bilərsiniz.</p>

 
        </div>

    </div>
</div>

<style>
        .privacy-main{
        width: 100%;
        height: auto;
        background-color: rgb(248,248,248);
        display: flex;
        justify-content: center;
    }
    .privacy-box {
        margin-top: 24px;
        margin-bottom: 24px;
        width: 1100px;
        border-radius: 10px;
        height: auto;
        background-color: white;
        display: flex;
        justify-content: space-between;
        padding: 40px 25px;
        h1, h2 {
            color: #333;
        }
        p {
            margin: 10px 0;
        }

    }


</style>
@endsection
