<footer  @if($hideFooter ?? false) style="display: none;" @endif class="bg-white py-5">
    <div class="container py-2">
        <div class="row justify-content-between align-items-start">
            <!-- Əlaqə və Sosial Media Bölməsi -->
            <div class="col-md-4 col-12 mb-4">
                <div class="d-flex flex-column">
                    <!-- Əlaqə Bölməsi -->
                    <div class="footer-contact mb-4">
                        <p class="for-assistance text-secondary mb-2" style="font-size: 1rem;">Hər hansı bir sualınız varsa, bizimlə əlaqə saxlayın</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="https://wa.me/994515032303" class="text-decoration-none d-flex align-items-center" style="font-size: 1rem;" target="_blank">
                                <i class="fab fa-whatsapp fs-4 me-2"></i>
                                <span class="text-secondary">+994 51 503 23 03</span>
                            </a>
{{--                            <a href="mailto:contact@example.com" class="text-decoration-none d-flex align-items-center" style="font-size: 1rem;">--}}
{{--                                <i class="far fa-envelope fs-4 me-2"></i>--}}
{{--                                <span class="text-secondary">contact@example.com</span>--}}
{{--                            </a>--}}
                        </div>
                    </div>

                    <!-- Sosial Media Bölməsi -->
                    <div>
                        <p class="text-secondary mb-2" style="font-size: 1rem;">Sosial media</p>
                        <div class="d-flex gap-3">
                            <a href="https://www.instagram.com/Premiumb0x.az" class="text-secondary" style="font-size: 1.5rem;" target="_blank">
                                <i class="fab fa-instagram fs-4"></i>
                            </a>
{{--                            <a href="https://www.facebook.com/Box-and-Tale-824210911112610" class="text-secondary" style="font-size: 1.5rem;">--}}
{{--                                <i class="fab fa-facebook fs-4"></i>--}}
{{--                            </a>--}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Naviqasiya Linkləri Bölməsi -->
            <div class="col-md-4 col-12 mb-4">
                <nav class="row">
                    <div class="col-6">
                        <a href="/build-a-box" class="text-secondary text-decoration-none d-block mb-2" style="font-size: 1rem;">Bir Qutu Yaradın</a>
                        <a href="/premade" class="text-secondary text-decoration-none d-block mb-2" style="font-size: 1rem;">Hazır Qutular</a>
                        <a href="/corporate" class="text-secondary text-decoration-none d-block mb-2" style="font-size: 1rem;">Korporativ Hədiyyələr</a>
                        <a href="/blog" class="text-secondary text-decoration-none d-block mb-2" style="font-size: 1rem;">Bloq</a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('about_us') }}" class="text-secondary text-decoration-none d-block mb-2" style="font-size: 1rem;">Haqqımızda</a>
                        <a href="{{ route('contact_us') }}" class="text-secondary text-decoration-none d-block mb-2" style="font-size: 1rem;">Əlaqə</a>
                        <a href="{{ route('faq') }}" class="text-secondary text-decoration-none d-block mb-2" style="font-size: 1rem;">Tez-tez Verilən Suallar</a>
                        <a href="{{ route('privacy_policy') }}" class="text-secondary text-decoration-none d-block mb-2" style="font-size: 1rem;">Məxfilik Siyasəti</a>
                    </div>
                </nav>
            </div>

            <!-- Logo Bölməsi -->
            <div class="col-md-4 col-12 text-center">
                <div>
                    <a href="https://saythub.az" target="_blank">
                        <img src="{{ asset('assets/front/img/saythub.png') }}" class="img-fluid" style="max-width: 100px" alt="saythub.az">
                    </a>
                    <p class="mt-2 small" style="color: #a3907a; font-size: 0.9rem;">
                        tərəfindən <a href="https://saythub.az" target="_blank" style="color: inherit; text-decoration: none;"><strong>Saythub.az</strong></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .container {
        max-width: 90%;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .col-md-4,
    .col-12 {
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 100%;
        }
        .col-6 {
            flex: 0 0 100%;
        }
        .col-md-4, .col-6 {
            margin-bottom: 1.5rem;
        }
    }

    .footer-contact a, .footer-contact p {
        font-size: 1rem;
    }

    .footer-contact p, .footer-contact a {
        font-size: 1rem;
    }
</style>
