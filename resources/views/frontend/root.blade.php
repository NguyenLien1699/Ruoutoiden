<!DOCTYPE html>
<html lang="en">
    @include('frontend.rootHead')
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ URL::asset($setting->logo) }}"  style="height: 60px;"/>
                </a>
                <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
                </button>

                <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav nav ml-auto">
                    <li class="nav-item"><a href="#home-section" class="nav-link"><span>Trang chủ</span></a></li>
                    <li class="nav-item"><a href="#about-section" class="nav-link"><span>Giới thiệu</span></a></li>
                    <li class="nav-item"><a href="#projects-section" class="nav-link"><span>Sản phẩm</span></a></li>
                    <li class="nav-item"><a href="#testimony-section" class="nav-link"><span>Đánh giá</span></a></li>
                    <li class="nav-item"><a href="#blog-section" class="nav-link"><span>Tin tức</span></a></li>
                    <li class="nav-item"><a href="#contact-section" class="nav-link"><span>Liên hệ</span></a></li>
                </ul>
                </div>
            </div>
        </nav>
        @yield('content')
        @include('frontend.footer')
        @include('frontend.loader')
        <script src="/frontend/js/jquery.min.js"></script>
        <script src="/frontend/js/jquery-migrate-3.0.1.min.js"></script>
        <script src="/frontend/js/popper.min.js"></script>
        <script src="/frontend/js/bootstrap.min.js"></script>
        <script src="/frontend/js/jquery.easing.1.3.js"></script>
        <script src="/frontend/js/jquery.waypoints.min.js"></script>
        <script src="/frontend/js/jquery.stellar.min.js"></script>
        <script src="/frontend/js/owl.carousel.min.js"></script>
        <script src="/frontend/js/jquery.magnific-popup.min.js"></script>
        <script src="/frontend/js/aos.js"></script>
        <script src="/frontend/js/jquery.animateNumber.min.js"></script>
        <script src="/frontend/js/scrollax.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
        <script src="/frontend/js/google-map.js"></script>
        <script src="/frontend/js/main.js"></script>
    </body>
</html>