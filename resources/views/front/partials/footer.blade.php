<footer @if($hideFooter ?? false) style="display: none;" @endif class="footer">
    <div class="footer-container">
        <!-- Contact and Social Media Section -->
        <div class="footer-section">
            <div class="footer-content">
                <!-- Contact Section -->
                <div class="footer-contact">
                    <p class="footer-text">Hər hansı bir sualınız varsa, bizimlə əlaqə saxlayın</p>
                    <div class="contact-links">
                        <a href="https://wa.me/994515032303" class="contact-link" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <span>+994 51 503 23 03</span>
                        </a>
                    </div>
                </div>

                <!-- Social Media Section -->
                <div class="social-media">
                    <p class="footer-text">Sosial media</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/Premiumb0x.az" class="social-link" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Links Section -->
        <div class="footer-section">
            <div class="footer-nav">
                <div class="nav-links">
                    <a href="{{ route('choose_a_box') }}" class="footer-link">Bir Qutu Yaradın</a>
                    <a href="{{ route('choose_premade_box') }}" class="footer-link">Hazır Qutular</a>
                    <a href="{{ route('corporate-gifts') }}" class="footer-link">Korporativ Hədiyyələr</a>
                    <a href="{{ route('blogs') }}" class="footer-link">Bloq</a>
                    <a href="{{ route('about_us') }}" class="footer-link">Haqqımızda</a>
                    <a href="{{ route('contact_us') }}" class="footer-link">Əlaqə</a>
                    <a href="{{ route('faq') }}" class="footer-link">Tez-tez Verilən Suallar</a>
                    <a href="{{ route('privacy_policy') }}" class="footer-link">Məxfilik Siyasəti</a>
                </div>
            </div>
        </div>

        <!-- Logo Section -->
        <div class="footer-section logo-section">
            <a href="https://saythub.az" target="_blank">
                <img src="{{ asset('assets/front/img/saythub.png') }}" alt="saythub.az">
            </a>
            <p class="copyright">
                <a href="https://saythub.az" target="_blank"><strong>Saythub.az</strong> tərəfindən</a>
            </p>
        </div>
    </div>
</footer>

<style>
    .footer {
        background-color: white;
        padding: 3rem 0;
    }

    .footer-container {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 2rem;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 3rem;
    }

    .footer-section {
        display: flex;
        flex-direction: column;
    }

    .footer-content {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .footer-text {
        color: #6c757d;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        text-align: left;
    }

    .contact-links {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .footer-contact {
        text-align: left;
        margin-bottom: 1.5rem;
    }

    .contact-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #6c757d;
        text-decoration: none;
        font-size: 0.95rem;
    }

    .contact-link i {
        font-size: 1.25rem;
    }

    .social-links {
        display: flex;
        gap: 1.25rem;
    }

    .social-link {
        color: #6c757d;
        font-size: 1.5rem;
        transition: color 0.2s;
    }

    .social-link:hover {
        color: #4a4a4a;
    }

    .footer-nav {
        display: flex;
        justify-content: center;
    }

    .nav-links {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        max-width: 250px;
    }

    .footer-link {
        color: #6c757d;
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.2s;
        padding: 0.1rem 0;
        text-align: left;
        line-height: 1.2;
    }

    .footer-link:hover {
        color: #4a4a4a;
    }

    .logo-section {
        align-items: center;
        text-align: center;
    }

    .logo-section img {
        max-width: 70px;
        height: auto;
    }

    .copyright {
        margin-top: 1rem;
        font-size: 0.9rem;
    }

    .copyright a {
        color: #a3907a;
        text-decoration: none;
    }

    @media (max-width: 992px) {
        .footer-container {
            grid-template-columns: repeat(2, 1fr);
            max-width: 800px;
        }

        .logo-section {
            grid-column: span 2;
        }

        .nav-links {
            max-width: 300px;
            margin: 0 auto;
        }

        .footer-contact, .social-media {
            max-width: 300px;
            margin: 0 auto;
        }
    }

    @media (max-width: 768px) {
        .footer {
            padding: 2.5rem 0;
        }

        .footer-container {
            grid-template-columns: 1fr;
            gap: 2.5rem;
            max-width: 600px;
            padding: 0 1.5rem;
        }

        .logo-section {
            grid-column: auto;
        }

        .nav-links {
            max-width: 100%;
            gap: 0.25rem;
            align-items: center;
        }

        .footer-content {
            align-items: center;
            max-width: 100%;
        }

        .footer-contact, .social-media {
            width: 100%;
            max-width: 100%;
            text-align: center;
        }

        .contact-links {
            align-items: center;
        }

        .footer-text {
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .contact-link {
            padding: 0.25rem 0;
            justify-content: center;
        }

        .social-links {
            justify-content: center;
        }

        .footer-link {
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .footer {
            padding: 2rem 0;
        }

        .footer-container {
            padding: 0 1.25rem;
        }

        .footer-text {
            font-size: 0.9rem;
        }

        .contact-link {
            font-size: 0.9rem;
        }
    }
</style>
