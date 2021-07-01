<footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Về chúng tôi</h2>
                    <p>{{ $setting->slogan}}</p>
                    @if(!empty($setting->link_facebook)
                        || !empty($setting->link_youtube)
                        || !empty($setting->link_twitter)
                        || !empty($setting->link_linkedin)
                        || !empty($setting->link_pinterest))
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        @if(!empty($setting->link_twitter))
                        <li class="ftco-animate fadeInUp ftco-animated">
                            <a href="{{ $setting->link_twitter }}"><span class="icon-twitter"></span></a>
                        </li>
                        @endif
                        @if(!empty($setting->link_facebook))
                        <li class="ftco-animate fadeInUp ftco-animated">
                            <a href="{{ $setting->link_twitter }}"><span class="icon-facebook"></span></a>
                        </li>
                        @endif
                        @if(!empty($setting->link_youtube))
                        <li class="ftco-animate fadeInUp ftco-animated">
                            <a href="{{ $setting->link_youtube }}"><span class="icon-youtube"></span></a>
                        </li>
                        @endif
                        @if(!empty($setting->link_linkedin))
                        <li class="ftco-animate fadeInUp ftco-animated">
                            <a href="{{ $setting->link_linkedin }}"><span class="icon-linkedin"></span></a>
                        </li>
                        @endif
                        @if(!empty($setting->link_pinterest))
                        <li class="ftco-animate fadeInUp ftco-animated">
                            <a href="{{ $setting->link_pinterest }}"><span class="icon-pinterest"></span></a>
                        </li>
                        @endif
                    </ul>
                    @endif
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">Links</h2>
                    <ul class="list-unstyled">
                        <li><a href="#home-section"><span class="icon-long-arrow-right mr-2"></span>Trang chủ</a>
                        </li>
                        <li><a href="#about-section"><span class="icon-long-arrow-right mr-2"></span>Giới thiệu</a>
                        </li>
                        <li><a href="#projects-section"><span class="icon-long-arrow-right mr-2"></span>Sản phẩm</a>
                        </li>
                        <li><a href="#blog-section"><span class="icon-long-arrow-right mr-2"></span>Tin tức</a>
                        </li>
                        <li><a href="#contact-section"><span class="icon-long-arrow-right mr-2"></span>Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Sản phẩm</h2>
                    <ul class="list-unstyled">
                        @if(isset($products) && count($products) > 0)
                            @foreach($products as $item)
                            <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>{{ $item->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Liên hệ</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">{{ $setting->address }}</span>
                            </li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">{{ $setting->phone }}</span></a>
                            </li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">{{ $setting->email }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>{{ $setting->text_footer }}</p>
            </div>
        </div>
    </div>
</footer>