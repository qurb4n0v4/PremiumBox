<div class="navbar" style="height: 130px; background-color: transparent; position: absolute; top: 0; left: 0; width: 100%; z-index: 1000;">
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

<style>
    .container-navbar {
        display: flex;
        flex-direction: row;
        width: 80%;
        margin: auto;
        justify-content: space-between;
    }
    .navbar-elements-top .login-navbar:hover {
        text-decoration: underline;
    }
    .logo-side-navbar img {
        width: 70px;
        height: 70px;
        margin-top: 30px;
    }
    .list-side-navbar{
        margin-top: 40px;
    }
    .navbar-elements-top{
        justify-content: end;
        font-size: 14px;
    }
    .navbar-elements-top li a {
        /*color: rgb(163, 144, 122);*/
        color: #ffffff;
    }
    .navbar-elements-bottom li a{
        font-weight: bold;
        font-size: 18px;
        /*color: rgb(163, 144, 122);*/
        color: #ffffff;
    }
    .navbar-elements-top,
    .navbar-elements-bottom {
        display: flex;
        flex-direction: row;
        gap: 20px;
    }
    .navbar-elements-top li,
    .navbar-elements-bottom li {
        list-style: none;
    }
    .navbar-elements-top li a,
    .navbar-elements-bottom li a {
        text-decoration: none;
    }
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-btn {
        color: #ffffff;
        font-weight: bold;
        font-size: 18px;
    }

    .dropdown-btn:hover {
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: rgb(255, 255, 255);
        min-width: 160px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px;
        z-index: 1;
        margin-left: -10px;
        margin-top: 5px;
       border-radius: 13px;
    }

    .dropdown-content a {
        margin: 5px 15px;
        color: rgb(163, 144, 122) !important;
        padding: 4px 16px;
        font-size: 14px !important;
        text-decoration: none;
        display: block;
        font-weight: 400;
    }

    .dropdown-content a:hover {
        background-color: #efefef;
    }

    .dropdown.open .dropdown-content {
        display: block;
    }
</style>

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
</script>
