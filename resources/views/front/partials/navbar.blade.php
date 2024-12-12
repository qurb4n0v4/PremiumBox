<div class="navbar transparent" style="height: 130px; background-color: transparent; position: absolute; top: 0; left: 0; width: 100%; z-index: 1000;">
    <div class="container-navbar">
        <div class="logo-side-navbar">
            <img src="{{ asset('assets/front/img/giftbox.jpg') }}" alt="Logo Image">
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
                    <li><a href="">Build a Box</a></li>
                    <li><a href="">Premade</a></li>
                    <li><a href="">Corporate Gifts</a></li>
                    <li><a href="">Blog</a></li>
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
    const dropdown = document.querySelector('.dropdown');
    const dropdownBtn = document.querySelector('.dropdown-btn');

    dropdownBtn.addEventListener('click', function (event) {
        event.stopPropagation();
        dropdown.classList.toggle('open');
    });

    document.addEventListener('click', function (event) {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('open');
        }
    });


    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.querySelector('.navbar');

        // Check if the current URL path matches the home page
        const isTransparentPage = window.location.pathname === '/'; // Update this to match your actual home page URL

        if (isTransparentPage) {
            navbar.classList.add('transparent');
        } else {
            navbar.classList.remove('transparent');
        }

        // Optional: Make it transparent only at the top of the page
        if (isTransparentPage) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.remove('transparent');
                } else {
                    navbar.classList.add('transparent');
                }
            });
        }
    });


</script>
