@extends('layouts.template')

@section('title_page', $title)

@section('content')
<div class="col-12">
    {{ Form::open(array('class' =>"card",'method' => "post", 'enctype' => "multipart/form-data")) }}
        <div class="card-header">
            <h3 class="card-title">Cập nhật bài viết</h3>
        </div>
        <div class="card-body row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('thumb', 'Hình ảnh', array('class' => 'form-label')) }}
                    {{ Form::file('thumb', $attributes = array('style' => "display: none;", 'target'=>'imgThumb')) }}
                    @if($errors->has('thumb'))
                        <div class="invalid-feedback">{{$errors->first('thumb')}}</div>
                    @endif
                </div>
                <label class="imagecheck mb-4" for="thumb">
                    <figure class="imagecheck-figure">
                        <img src="{{ isset($thumbnail) ? $thumbnail : '/images/uploadimage.jpg' }}" alt="" class="imagecheck-image" id="imgThumb">
                    </figure>
                </label>
            </div>
            <div class="col-lg-8">
                <div class="form-group">
                    {{ Form::label('title', 'Tiêu đề', array('class' => 'form-label')) }}
                    {{ Form::text('title', request()->title ?? $title, $attributes = array('class' => 'form-control'.($errors->has('title')?' is-invalid':''))) }}
                    @if($errors->has('title'))
                        <div class="invalid-feedback">{{$errors->first('title')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('owner', 'Tiêu đề phụ', array('class' => 'form-label')) }}
                    {{ Form::text('owner', request()->owner ?? $owner, $attributes = array('class' => 'form-control'.($errors->has('owner')?' is-invalid':''))) }}
                    @if($errors->has('owner'))
                        <div class="invalid-feedback">{{$errors->first('owner')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('year_old', 'Số năm hoạt động', array('class' => 'form-label')) }}
                    {{ Form::number('year_old', request()->year_old ?? $year_old, $attributes = array('class' => 'form-control'.($errors->has('year_old')?' is-invalid':''))) }}
                    @if($errors->has('year_old'))
                        <div class="invalid-feedback">{{$errors->first('year_old')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('content', 'Nội dung', array('class' => 'form-label')) }}
                    {{ Form::textarea('content', isset($content)?$content:null, $attributes = array('class' => 'form-control summernote'.($errors->has('content')?' is-invalid':''))) }}
                    @if($errors->has('content'))
                        <div class="invalid-feedback">{{$errors->first('content')}}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary ml-auto">Lưu dữ liệu</button>
        </div>
    {{ Form::close() }}
</div>
@endsection

@section('jsinline')
<script>
    require(['jquery', 'summernote'], function($) {
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 350
            });
        });
    });
    require(['jquery', 'summernote'], function($) {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#' + $(input).attr('target')).attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 350
            });
            $('input[type="file"]').change(function() {
                readURL(this);
            });
        });
    });
</script>
@endsection

@section('cssinline')
<style>
.note-editor .btn i{
    font-size: 12px !important;
    font-weight: normal !important;
}
</style>
@endsection

@section('cssasset')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection

@section('jsasset')
<script src="{{ URL::asset('plugins/summernote/plugin.js') }}"></script>
@endsection