<div class="navbar">
    <div class="container-navbar">
        <div class="logo-side-navbar">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/front/img/giftbox.jpg') }}" alt="Logo Image"></a>
        </div>
        <div class="menu-button">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="list-side-navbar">
            <div>
                <ul class="navbar-elements-top" style="margin-bottom: 5px">
                    <li><a href="#" class="login-navbar">Login</a></li>
                    <li><a href="#" class="login-navbar">Register</a></li>
                    <li><a href="#">Cart</a></li>
                </ul>
            </div>
            <div>
                <ul class="navbar-elements-bottom">
                    <li><a href="{{ route('choose_a_box') }}">Build a Box</a></li>
                    <li><a href="">Premade</a></li>
                    <li><a href="{{ route('corporate-gifts') }}">Corporate Gifts</a></li>
                    <li><a href="{{ route('blogs') }}">Blog</a></li>
                    <li class="dropdown">
                        <div class="dropdown-btn">About Us <i class="fa-solid fa-caret-down" style="margin-left: 5px; font-size: 12px;"></i></div>
                        <div class="dropdown-content">
                            <a href="{{ route('about_us') }}">About Us</a>
                            <a href="{{ route('contact_us') }}">Contact Us</a>
                            <a href="{{ route('faq') }}">FAQ</a>
                            <a href="{{ route('privacy_policy') }}">Privacy Policy</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.createElement('div');
        overlay.className = 'menu-overlay';
        document.body.appendChild(overlay);

        const menuButton = document.querySelector('.menu-button');
        const navMenu = document.querySelector('.list-side-navbar');
        const dropdown = document.querySelector('.dropdown');
        const dropdownBtn = document.querySelector('.dropdown-btn');

        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            navMenu.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function() {
            navMenu.classList.remove('active');
            overlay.classList.remove('active');
        });

        dropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('open');
        });

        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('open');
            }
        });
    });
</script>
