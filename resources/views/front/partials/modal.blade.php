<!-- Register Modal -->
<div class="modal-overlay" id="register-modal">
    <div class="modal-content register-modal">
        <div class="modal-header">
            <h2>Qeydiyyat</h2>
        </div>
        <div class="modal-body">
            <form id="register-form" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Ad" required>
                </div>
                <div class="form-group">
                    <input type="email" id="register-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" id="register-password" name="password" placeholder="Şifrə" required>
                </div>
                <div class="form-group">
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Şifrə təsdiqi" required>
                </div>
                <div class="form-group">
                    <input type="tel" id="phone" name="phone" placeholder="Telefon nömrəsi" required>
                </div>
                <div class="form-group">
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Cins</option>
                        <option value="male">Kişi</option>
                        <option value="female">Qadın</option>
                        <option value="other">Bildirmək İstəmirəm</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Qeydiyyatdan keçin</button>
            </form>
            <p style="color: #898989;">Hesabınız var? <a href="#" id="switch-to-login">Daxil olun</a></p>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal-overlay" id="login-modal">
    <div class="modal-content login-modal">
        <div class="modal-header">
            <h2>Daxil Ol</h2>
        </div>
        <div class="modal-body">
            <form id="login-form" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" id="login-password" name="password" placeholder="Şifrə" required>
                </div>
                <button type="submit" class="submit-btn">Daxil Ol</button>
            </form>
            <p style="color: #898989;">Hesabınız yoxdur? <a href="#" id="switch-to-register">Qeydiyyat</a></p>
        </div>
    </div>
</div>

<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .register-modal {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        width: 400px;
        max-width: 90%;
    }

    .login-modal {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        width: 400px;
        max-width: 90%;
    }

    .modal-header {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 24px;
        color: #a3907a;
    }

    .close-modal {
        cursor: pointer;
        font-size: 18px;
        color: #999;
    }

    .form-group {
        margin-bottom: 15px;
        border: none;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: none;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
        margin-bottom: 20px;
        color: #333;
    }
    .form-group select {
        width: 100%;
        padding: 10px;
        border: none;
        border-bottom: 1px solid #ddd;
        /*border-radius: 5px;*/
        font-size: 14px;
        color: #898989;
        /*background-color: #f9f9f9;*/
    }

    .form-group select:focus {
        outline: none;
        /*border-color: #a58b71;*/
    }
    .submit-btn {
        padding: 12px;
        background-color: #a3907a;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-bottom: 20px !important;
    }
    #switch-to-login, #switch-to-register {
        color: #a3907a;
        text-decoration: none;
    }

</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const registerModal = document.getElementById('register-modal');
        const loginModal = document.getElementById('login-modal');
        const openRegisterBtn = document.querySelector('.register-navbar');
        const openLoginBtn = document.querySelector('.login-navbar');
        const closeButtons = document.querySelectorAll('.close-modal');
        const switchToLogin = document.getElementById('switch-to-login');
        const switchToRegister = document.getElementById('switch-to-register');

        const openModal = (modal) => (modal.style.display = 'flex');
        const closeModal = (modal) => (modal.style.display = 'none');

        openRegisterBtn.addEventListener('click', function (e) {
            e.preventDefault();
            openModal(registerModal);
        });

        openLoginBtn.addEventListener('click', function (e) {
            e.preventDefault();
            openModal(loginModal);
        });

        closeButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                closeModal(registerModal);
                closeModal(loginModal);
            });
        });

        switchToLogin.addEventListener('click', function (e) {
            e.preventDefault();
            closeModal(registerModal);
            openModal(loginModal);
        });

        switchToRegister.addEventListener('click', function (e) {
            e.preventDefault();
            closeModal(loginModal);
            openModal(registerModal);
        });

        window.addEventListener('click', function (e) {
            if (e.target === registerModal || e.target === loginModal) {
                closeModal(registerModal);
                closeModal(loginModal);
            }
        });

        const registerForm = document.getElementById('register-form');
        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (password !== confirmPassword) {
                alert('Şifrələr uyğun gəlmir!');
                return;
            }

            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('register-email').value,
                phone: document.getElementById('phone').value,
                password: password,
                password_confirmation: confirmPassword,
                gender: document.getElementById('gender').value,
            };

            try {
                const response = await fetch('/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                    },
                    body: JSON.stringify(formData),
                });

                const result = await response.json();
                if (response.ok) {
                    alert(result.message);
                    closeModal(registerModal);
                } else if (result.errors) {
                    Object.keys(result.errors).forEach(function (key) {
                        const error = result.errors[key];
                        alert(`${key}: ${error.join(', ')}`);
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Kayıt işlemi sırasında bir hata oluştu.');
            }
        });

        const loginForm = document.getElementById('login-form');
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = {
                email: document.getElementById('login-email').value,
                password: document.getElementById('login-password').value,
            };

            try {
                const response = await fetch('{{ route('login') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                    },
                    body: JSON.stringify(formData),
                });

                const result = await response.json();
                if (response.ok) {
                    const redirectUrl = result.redirect_url;
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                } else {
                    alert(result.message || 'Giriş işlemi başarısız');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Giriş işlemi sırasında bir hata oluştu.');
            }
        });
    });
</script>
