@if(isset($products) && count($products) > 0)
<section id="home-section" class="hero">
    {{-- <h3 class="vr">Chào mừng bạn</h3> --}}
    <div class="home-slider js-fullheight owl-carousel">
    @foreach($products as $item)
        <div class="slider-item js-fullheight">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
                <div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
                    <div class="one-third order-md-last img js-fullheight" style="background-image:url({{ $item->thumb_large }});">
                        <div class="overlay"></div>
                    </div>
                    <div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                        <div class="text">
                            <span class="subheading">Chào mừng bạn</span>
                            <h1 class="mb-4 mt-3">{{ $item->title }}</h1>
                            <p>{{ $item->short_description }}</p>

                            <p><a href="#" class="btn btn-primary px-5 py-3 mt-3">Chi tiết</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</section>
@endif