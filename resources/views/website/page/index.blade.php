@extends('layouts.template')

@section('title_page', 'Bài viết')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-4">
        <div class="page-header">
            <h1 class="page-title">
                Trang bài viết
            </h1>
        </div>
    </div>
</div>
@include('layouts.message.system')
@include('layouts.message.alert')
<div class="row">
    @foreach($pages as $page)
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="card-category">{{ $page->title }}</div>
                <div class="display-3 my-4">#{{ $page->id }}</div>
                <ul class="list-unstyled leading-loose">
                    <li style="text-align: right;"><strong style="float: left;">Chủ sở hữu :</strong> {{ $page->owner }}</li>
                    <li style="text-align: right;"><strong style="float: left;">Lượt xem :</strong> {{ number_format($page->view) }}</li>
                    <li style="text-align: right;"><strong style="float: left;">Trạng thái :</strong> {{ filter_var($page->is_show, FILTER_VALIDATE_BOOLEAN) ? 'Hiển thị' : 'Không hiển thị' }}</li>
                    <li style="text-align: right;"><strong style="float: left;">Tạo lúc :</strong> {{ date('d/m/Y H:i:s', strtotime($page->created_at)) }}</li>
                    <li style="text-align: right;"><strong style="float: left;">Cập nhật lúc :</strong> {{ date('d/m/Y H:i:s', strtotime($page->updated_at)) }}</li>
                </ul>
                <div class="text-center mt-6">
                    <a href="{{ route('website.pages.edit.show', ['id' => $page->id]) }}" class="btn btn-secondary btn-block">Cập nhật</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection