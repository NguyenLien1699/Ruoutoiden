@if(isset($page) && !is_null($page))
<section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb" id="about-section">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-6 col-lg-5 d-flex">
                <div class="img d-flex align-self-stretch align-items-center" style="background-image:url({{ $page->thumb }});">
                </div>
            </div>
            <div class="col-md-6 col-lg-7 pl-lg-5 py-5">
                <div class="py-md-5">
                    <div class="row justify-content-start pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading">{{ $page->owner }}</span>
                            <h2 class="mb-4" style="font-size: 34px; text-transform: capitalize;">{{ $page->title }}</h2>
                            {!! $page->content !!}
                        </div>
                    </div>
                    {{-- <div class="counter-wrap ftco-animate d-flex mt-md-3">
                        <div class="text p-4 bg-primary">
                            <p class="mb-0">
                                <span class="number" data-number="{{ $page->year_old }}">0</span>
                                <span>Số năm hoạt động</span>
                            </p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endif