<div class="navbar">
    <div class="container-navbar">
        <div class="logo-side-navbar">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/front/img/giftbox.jpg') }}" alt="Logo Şəkli"></a>
        </div>
        <div class="menu-button">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="list-side-navbar">
            <div>
                <ul class="navbar-elements-top" style="margin-bottom: 5px">
                    @auth
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-btn user-name-navbar">{{ Auth::user()->name }}</a>
                            <div class="user-dropdown-content">
                                <a href="{{ route('profile-details') }}">Profilim</a>
                                <a href="{{ route('orders') }}">Sifarişlərim</a>
                                <a href="{{ route('coupons') }}">Kuponlarım</a>
                                <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                    @csrf
                                    @method('POST')
                                    <button class="nav-logout" type="submit">Çıkış Yap</button>
                                </form>


                            </div>
                        </li>
                        <li><a href="{{ route('cart.index') }}" class="navbar-cart">Səbət</a></li>
                    @else
                        <li><a href="#" class="login-navbar">Daxil ol</a></li>
                        <li><a href="#" class="register-navbar">Qeydiyyat</a></li>
                        <li><a href="{{ route('cart.index') }}">Səbət</a></li>
                    @endauth
                </ul>

            </div>
            <div>
                <ul class="navbar-elements-bottom">
                    <li><a href="{{ route('choose_a_box') }}">Bir Qutu Yaradın</a></li>
                    <li><a href="{{ route('choose_premade_box') }}">Hazır Qutular</a></li>
                    <li><a href="{{ route('corporate-gifts') }}">Korporativ Hədiyyələr</a></li>
                    <li><a href="{{ route('blogs') }}">Bloq</a></li>
                    <li class="dropdown about-dropdown">
                        <div class="dropdown-btn">Haqqımızda <i class="fa-solid fa-caret-down" style="margin-left: 5px; font-size: 12px;"></i></div>
                        <div class="about-dropdown-content">
                            <a href="{{ route('about_us') }}">Haqqımızda</a>
                            <a href="{{ route('contact_us') }}">Təklifləriniz</a>
                            <a href="{{ route('faq') }}">Tez-tez Verilən Suallar</a>
                            <a href="{{ route('privacy_policy') }}">Məxfilik Siyasəti</a>
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
        const userDropdown = document.querySelector('.user-dropdown');
        const aboutDropdown = document.querySelector('.about-dropdown');

        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            navMenu.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function() {
            navMenu.classList.remove('active');
            overlay.classList.remove('active');
            if (userDropdown) userDropdown.classList.remove('open');
            aboutDropdown.classList.remove('open');
        });

        if (userDropdown) {
            const userDropdownBtn = userDropdown.querySelector('.dropdown-btn');
            userDropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdown.classList.toggle('open');
                aboutDropdown.classList.remove('open');
            });
        }

        const aboutDropdownBtn = aboutDropdown.querySelector('.dropdown-btn');
        aboutDropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            aboutDropdown.classList.toggle('open');
            if (userDropdown) userDropdown.classList.remove('open');
        });

        document.addEventListener('click', function(e) {
            if (userDropdown && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('open');
            }
            if (!aboutDropdown.contains(e.target)) {
                aboutDropdown.classList.remove('open');
            }
        });
    });

    document.getElementById('logoutButton').addEventListener('click', function() {
        fetch('/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({})
        })
            .then(response => response.json())
            .then(data => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            })
            .catch(error => {
                console.error('Logout error:', error);
            });
    });

</script>
