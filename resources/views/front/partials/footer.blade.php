<footer class="bg-white py-5">
    <div class="container py-2" style="width: 70%; margin: auto;">
        <div class="row justify-content-between align-items-center">
            <!-- Contact and Social Media Column -->
            <div class="col-md-3">
                <div class="d-flex flex-column">
                    <!-- Contact Section -->
                    <div class="footer-contact mb-4">
                        <p class="for-assistance text-secondary mb-2">For assistance, please contact us through</p>
                        <div class="d-flex flex-column gap-2">
                            <a href=""
                               class="text-decoration-none d-flex align-items-center">
                                <i class="fab fa-whatsapp fs-4 me-2"></i>
                                <span class="text-secondary">081311033691</span>
                            </a>
                            <a href="mailto:contact@example.com"
                               class="text-decoration-none d-flex align-items-center">
                                <i class="far fa-envelope fs-4 me-2"></i>
                                <span class="text-secondary">contact@example.com</span>
                            </a>
                        </div>
                    </div>

                    <!-- Social Media Section -->
                    <div>
                        <p class="text-secondary mb-2">Follow our social media</p>
                        <div class="d-flex gap-3">
                            <a href="https://www.instagram.com/boxandtale" class="text-secondary">
                                <i class="fab fa-instagram fs-4"></i>
                            </a>
                            <a href="https://www.facebook.com/Box-and-Tale-824210911112610" class="text-secondary">
                                <i class="fab fa-facebook fs-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Links Column -->
            <div class="col-md-3">
                <nav class="d-flex flex-column">
                    <a href="/build-a-box" class="text-secondary text-decoration-none">Build A Box</a>
                    <a href="/premade" class="text-secondary text-decoration-none">Premade</a>
                    <a href="/corporate" class="text-secondary text-decoration-none">Corporate Gifts</a>
                    <a href="/blog" class="text-secondary text-decoration-none">Blog</a>
                    <a href="{{ route('about_us') }}" class="text-secondary text-decoration-none">About Us</a>
                    <a href="{{ route('contact_us') }}" class="text-secondary text-decoration-none">Contact Us</a>
                    <a href="{{ route('faq') }}" class="text-secondary text-decoration-none">FAQ</a>
                    <a href="{{ route('privacy_policy') }}" class="text-secondary text-decoration-none">Privacy Policy</a>
                </nav>
            </div>

            <!-- Logo Column -->
            <div class="col-md-3 d-flex flex-column justify-content-center">
                <div class="text-center">
                    <img src="assets/front/img/giftbox.jpg" class="img-fluid" style="width: 100px" alt="Box and Tale - Logo">
                    <p class="mt-2 small" style="color: #a3907a;">by <strong>Saythub.az</strong></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .container {
        max-width: 70% !important;
    }

    @media (max-width: 768px) {
        .container {
            max-width: 90% !important;
        }
    }
</style>
