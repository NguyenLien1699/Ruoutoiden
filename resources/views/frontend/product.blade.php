@if(isset($products) && count($products) > 0)
<section class="ftco-section ftco-project bg-light" id="projects-section">
    <div class="container px-md-5">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Nghiên cứu</span>
                <h2 class="mb-4">Sản phẩm</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 testimonial">
                <div class="carousel-project owl-carousel">
                    @foreach($products as $item)
                    <div class="item">
                        <div class="project">
                            <div class="img">
                                <img src="{{ $item->thumb }}" class="img-fluid" alt="Colorlib Template">
                                <div class="text px-4">
                                    <h3><a href="#">{{ $item->title }}</a></h3>
                                    <span>{{ $item->price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif