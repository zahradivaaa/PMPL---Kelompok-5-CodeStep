<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeStep</title>

    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <img src="{{ asset('img/logo dan codestep.png') }}" class="logo" alt="CodeStep Logo">

        <div class="nav-right">
            <a href="/login" class="btn-login">Masuk</a>
            <a href="/register" class="register">Register</a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <img src="{{ asset('img/landingpage.png') }}" class="hero-image" alt="Landing Page Background">

        <div class="hero-text">
            <h1>
                <span class="blue">Code</span><span class="orange">Step</span>
            </h1>
            <p>
                adalah platform pembelajaran pemrograman dasar yang membantu siswa
                belajar secara bertahap, dilengkapi kuis dan fitur progress tracker
                untuk memantau perkembangan belajar.
            </p>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-content">

            <!-- Kiri: Logo + Deskripsi -->
            <div class="footer-left">
                <img src="{{ asset('img/logo dan codestep.png') }}" class="footer-logo" alt="CodeStep Logo Full">
                <p class="footer-desc">
                    Di CodeStep, kami membantu siswa belajar pemrograman dasar secara bertahap dan terarah.
                </p>
            </div>

            <!-- Kanan: Contact Us -->
            <div class="footer-right">
                <h3 class="contact-title">Contact Us</h3>

                <div class="contact-list">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <img src="{{ asset('img/emailicon.png') }}" alt="Email">
                        </div>
                        <a href="mailto:codestep@gmail.com" class="contact-link">codestep@gmail.com</a>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <img src="{{ asset('img/telepon.png') }}" alt="Phone">
                        </div>
                        <a href="tel:08138231921" class="contact-link">0813-8231-1921</a>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <img src="{{ asset('img/instagramicon.png') }}" alt="Instagram">
                        </div>
                        <a href="https://instagram.com/codeStep.id" target="_blank" class="contact-link">@codeStep.id</a>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    <!-- COPYRIGHT -->
    <div class="copyright">
        <p>© 2026 CodeStep. All rights reserved.</p>
    </div>

</body>
</html>