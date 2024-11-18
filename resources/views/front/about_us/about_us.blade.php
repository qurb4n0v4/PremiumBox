@extends('front.layouts.app')

@section('title', 'About Us | BOX & TALE')

@section('content')
<div class="about-main">
    <div class="about-box">
        <div class="about-left">
            <h1>Box & Tale</h1>
            <h3>Ilkin Humbatov tərəfindən</h3>
            <img src="assets/front/img/979.webp" alt="" />
        </div>
        <div class="about-right">
            <p>
                Box and Tale onlayn əsaslı hədiyyə təchizatçısıdır. Biz burada,
                müştərilərimizə hədiyyə qutası və içindəkiləri hazırlamaqda kömək
                edirik, beləliklə, özəl gününüzü sevdiklərinizlə tamamlaya
                bilərsiniz. Hədiyyə qutası içeriğini seçmək üçün məhsul çeşidimizdən
                seçim edə bilərsiniz.
                <br /><br />
                Biz inanırıq ki, hər bir müştərimizin yaxın insanları ilə xüsusi və
                bənzərsiz əlaqələri var, buna görə də biz müştərilərimizə öz şəxsi
                toxunuşlarını hədiyyələr vasitəsilə ifadə etmək imkanı təqdim
                edirik. Bu hədiyyə qutuları hər bir alıcıya uyğun olaraq xüsusi
                hazırlanır və müştərilərimizin unikal ehtiyaclarını təmsil edir.
                <br /><br />
                Eyni zamanda, müştərilərimiz üçün hədiyyə alış-verişini daha
                əlverişli etmək məqsədini güdürük. Biz istifadəçi dostu veb sayt
                sistemi ilə hədiyyə almağı asanlaşdırırıq, beləliklə, sadəcə bir
                neçə kliklə saytımızda seçimlərinizi edirsiniz və qalanını biz təmin
                edirik!
            </p>
        </div>
    </div>
</div>

<div class="howworks">
    <div class="howmain">
        <div class="howworkswrite">
            <h1>Necə işləyir?</h1>
        </div>
        <div class="worksetap">
            <div class="etapsnumber">
                <p>Qutu qurun və ya əvvəlcədən hazırlanmış qutularımızı seçin</p>
            </div>
            <div class="etapsnumber">
                <p>Sifariş verin və ödənişi tamamlayın</p>
            </div>
            <div class="etapsnumber">
                <p>2-5 gün istehsal</p>
            </div>
            <div class="etapsnumber">
                <p>Hədiyyə Seçdiyiniz Kuryerlə Çatdırılır</p>
            </div>
        </div>
    </div>
</div>

<div class="webegin">
    <div class="webeginmain">
        <div class="beginleft">
            <h2>Başlayaq?</h2>
            <p class="beginnormalp">Öz Fərdi Hədiyyənizi Yaradın</p>
            <button>QUTU QUR</button>
            <p class="beginnormalp">Hazır Hədiyyə Paketləri alın</p>
            <button>HAZIRLANMIŞ QUTU</button>
            <p class="beginnormalp">Korporativ Hədiyyələr və Xüsusi Layihələr</p>
            <button>KORPORATİV HƏDİYYƏLƏR</button>
            <p class="formoreinfo">Əlavə məlumat üçün Bizimlə əlaqə saxlayın</p>
        </div>
        <div class="beginright">
            <img src="assets/front/img/980.webp" alt="" />
        </div>
    </div>
</div>


<style>

    .about-main,
    .webegin {
        width: 100%;
        height: auto;
        background-color: rgb(248,248,248);
        display: flex;
        justify-content: center;
    }
    .about-box,
    .webeginmain {
        margin-top: 24px;
        width: 1100px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        height: auto;
        background-color: white;
        display: flex;
        justify-content: space-between;
        padding: 40px 25px;

    }
    .about-left,
    .beginright {
        width: 49%;
        height: auto;
    }
    .about-right{
        width: 49%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .beginleft{
        width: 49%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .beginleft h2{
        font-size: 28.8px;
        margin-bottom: 36px;
        color: #a3907a;
    }
    .about-right p{
        color: #a3907a;
        font-size: 0.9rem;
    }
    .beginleft .beginnormalp{
        color: rgb(137,137,137);
        font-size: 18px;
    }
    .beginleft .formoreinfo{
        width: 300px;
        display: flex;
        color: rgb(137,137,137);
        text-align: center;
    }

    .beginleft button {
        height: 35px;
        color: #a3907a;
        border-color: #a3907a;
        margin-top: 15px;
        margin-bottom: 35px;
        border-radius: 10px;
    }

    .beginleft button:nth-of-type(1) {
        width: 120px;
    }

    .beginleft button:nth-of-type(2) {
        width: 150px;
    }

    .beginleft button:nth-of-type(3) {
        width: 200px;
    }




    .about-left img,
    .beginright img {
        width: 513px;
        height: 521px;
        margin-top: 29px;
    }
    .about-left h1{
        font-size: 2.25rem;
        color: #a3907a;
    }
    .about-left p,
    .beginright p {
        font-size: 18px;
        margin-top: 17px;
        color: #a3907a;
    }
    /* about box finish */
    /* how it works starts */
    .howworks{
        width: 100%;
        height: auto;
        background-color: rgb(248,248,248);
        display: flex;
        justify-content: center;
    }

    .howmain{
        width: 1100px;
        height: auto;
        background-color: #a3907a;
        display: flex;
        flex-direction: column;
        padding: 40px 48px 40px 48px;
    }
    .howworkswrite{
        width: 100%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .howworkswrite h1{
        font-size: 21.6px;
        color: white;
    }
    .worksetap{
        width: 100%;
        height: auto;
        display: flex;
        justify-content: space-between;
        margin-top: 30px;

    }
    .etapsnumber {
        width: 220px;
        height: 78px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        border: 1px solid white;
        padding: 8px;
    }

    .etapsnumber p{
        font-size: 14.6px;
        color: white;
    }


    @media screen and (max-width: 1100px) {
        .about-box,
        .webeginmain {
            width: 960px;
        }
        .about-left img,
        .beginright img {
            width: 312px;
            height: 312px;
        }
        .howmain{
            width: 960px;
        }
        .etapsnumber{
            width: 180px;
            height: 102px;
        }
    }
    @media screen and (max-width: 991px) {
        .about-box,
        .webeginmain {
            width: 720px;
        }
        .howmain{
            width: 720px;
        }
        .etapsnumber{
            height: 150px;
            width: 118px;
        }

    }

    @media screen and (max-width: 768px) {
        .about-box,
        .webeginmain {
            width: 540px;
            display: flex;
            flex-direction: column;
            gap: 50px;
        }
        .howmain{
            width: 540px;
        }
        .worksetap{
            display: flex;
            flex-direction: column;
            gap: 50px;
        }
        .etapsnumber{
            width: 100%;
            height: 56px;
        }
        .about-left,
        .beginright {
            width: 100%;
        }
        .about-left img,
        .beginright img{
            width: 492px;
            height: 492px;
        }
        .about-right,
        .beginleft{
            width: 100%;
        }
    }

    @media screen and (max-width: 574px) {
        .about-box,
        .webeginmain{
            width: 100%;
        }
        .about-left img,
        .beginright img{
            width: 100%;
            height: auto;
        }
    }

</style>

@endsection

