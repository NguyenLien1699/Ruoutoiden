@if(isset($testimony) && count($testimony) > 0)
<section class="ftco-section testimony-section" id="testimony-section">
    <div class="container">
        <div class="row justify-content-center pb-3">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <h2 class="mb-4">Nhận xét từ khách</h2>
            </div>
        </div>
        <div class="row ftco-animate justify-content-center">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">
                    @foreach($testimony as $item)
                    <div class="item">
                        <div class="testimony-wrap text-center py-4 pb-5">
                            <div class="user-img" style="background-image: url('{{ $item->thumb }}')">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div>
                            <div class="text px-4 pb-5">
                                <p class="mb-4">{{ $item->content }}</p>
                                <p class="name">{{ $item->name }}</p>
                                <span class="position">{{ $item->position }}</span>
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