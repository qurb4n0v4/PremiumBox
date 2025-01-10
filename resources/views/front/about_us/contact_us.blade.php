@extends('front.layouts.app')

@section('title', 'Bizimlə Əlaqə | BOX & TALE')

@section('content')
    <div class="contact-main">
        <div class="container contact-box">
            <div class="row">
                <div class="col-lg-6 col-md-6 contact-left">
                    <h1>Əlaqə</h1>
                    <h5></h5>
                    <p>Əgər daha çox sualınız varsa, GiftBox komandasına aşağıdakı əlaqə vasitələri ilə müraciət edə bilərsiniz:</p>
                    <div class="contact-details">
                        <p>
                            <i class="bi bi-telephone-fill"> : </i>+1234567890
                        </p>
                        <p>
                            <i class="bi bi-envelope-fill"> : </i><a href="mailto:info@giftbox.com" class="text-decoration-none" style="color: #a3907a;">info@giftbox.com</a>
                        </p>
                        <p>
                            <i class="bi bi-instagram"> : </i><a href="" target="_blank" class="text-decoration-none" style="color: #a3907a;">@giftbox</a>
                        </p>
                    </div>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label contact-label">Adınız:</label>
                            <input type="text" class="form-control contact-input" id="name" name="name" placeholder="Adınızı daxil edin" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label contact-label">E-poçt:</label>
                            <input type="email" class="form-control contact-input" id="email" name="email" placeholder="E-poçtunuzu daxil edin" required>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label contact-label">Mesajınız:</label>
                            <textarea id="message" name="message" class="form-control contact-input" rows="4" placeholder="Mesajınızı yazın" required></textarea>
                        </div>

                        <button type="submit" class="btn contact-submit">Göndər</button>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6 contact-right">
                    <img src="{{ asset('assets/front/img/violet.webp') }}" alt="Əlaqə Şəkli" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>


    <style>
        /*Contact-us starts*/
        .contact-main{
            width: 100%;
            height: auto;
            background-color: rgb(248,248,248);
            display: flex;
            justify-content: center;
        }

        .contact-box {
            margin: 24px 0;
            width: 100%;
            max-width: 1100px;
            border-radius: 10px;
            background-color: white;
            padding: 40px 25px;
        }
        .contact-right {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }
        .contact-right img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .contact-left h1 {
            font-size: 2.25rem;
            color: #a3907a;
        }

        .contact-left p {
            color: #a3907a;
            font-size: 0.9rem;
        }
        .contact-label{
            color: #a3907a;
        }
        .contact-input {
            color: #898989;
        }
        .contact-submit {
            background-color: #ffffff;
            color: #a3907a;
            border: 1px solid #a3907a;
        }
        .contact-submit:hover {
            background-color: #a3907a;
            color: #ffffff;
        }

        /* Mobile responsive adjustments */
        @media (max-width: 991px) {
            .contact-right img {
                max-width: 100%;
                height: auto;
            }
        }

        @media (max-width: 768px) {
            .contact-main {
                padding: 20px 0;
            }

            .contact-right img {
                width: 100%;
                height: auto;
            }

            .contact-box {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .contact-left h1 {
                font-size: 1.75rem;
            }

            .contact-right img {
                width: 100%;
                height: auto;
            }
        }
    </style>
@endsection
