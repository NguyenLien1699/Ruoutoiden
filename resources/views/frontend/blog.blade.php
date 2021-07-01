@if(isset($posts) && count($posts) === 3)
<section class="ftco-section bg-light" id="blog-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Bài viết</span>
                <h2 class="mb-4">Tin Tức nổi bật</h2>
                <p>Cập nhật tin tức nổi bật</p>
            </div>
        </div>
        <div class="row d-flex">
            @foreach($posts as $post)
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                    <a href="single.html" class="block-20" style="background-image: url({{ $post->thumb }});">
                    </a>
                    <div class="text mt-3 float-right d-block">
                        <div class="d-flex align-items-center pt-2 mb-4 topp">
                            <div class="one mr-2">
                                <span class="day">{{ date('d', strtotime($post->updated_at)) }}</span>
                            </div>
                            <div class="two">
                                <span class="yr">{{ date('Y', strtotime($post->updated_at)) }}</span>
                                <span class="mos">{{ date('F', strtotime($post->updated_at)) }}</span>
                            </div>
                        </div>
                        <h3 class="heading"><a href="single.html">{{ Illuminate\Support\Str::limit($post->title, 60, '...') }}</a></h3>
                        <p>{{ Illuminate\Support\Str::limit($post->short_description, 100, '...') }}</p>
                        <div class="d-flex align-items-center mt-4 meta">
                            <p class="mb-0"><a href="#" class="btn btn-primary">Chi tiết <span class="ion-ios-arrow-round-forward"></span></a>
                            </p>
                            <p class="ml-auto mb-0">
                                <a href="#" class="mr-2">{{ $post->owner }}</a>
                                <a href="#" class="meta-chat"><span class="icon-chat"></span> {{ $post->view }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif