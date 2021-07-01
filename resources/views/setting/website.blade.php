@extends('layouts.template')

@section('title_page', 'Cài đặt')

@section('content')
@include('layouts.message.system')

{{ Form::open(array('method' => "post", 'enctype' => "multipart/form-data")) }}
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Hình ảnh</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('fav', 'Icon website', array('class' => 'form-label')) }}
                    {{ Form::file('fav', $attributes = array('style' => "display: none;",'target'=>'imgFav')) }}
                    @if($errors->has('fav'))
                        <div class="invalid-feedback">{{$errors->first('fav')}}</div>
                    @endif
                </div>
                <div class="row gutters-sm">
                    <div class="col-12">
                        <label class="imagecheck mb-4" for="fav">
                            <figure class="imagecheck-figure">
                                <img src="{{ $fav }}" alt="" class="imagecheck-image" id="imgFav">
                            </figure>
                        </label>
                    </div>
                </div>
                <!-- <div class="form-group">
                    {{ Form::label('logo', 'Logo', array('class' => 'form-label')) }}
                    {{ Form::file('logo', $attributes = array('style' => "display: none;",'target'=>'imgLogo')) }}
                    @if($errors->has('logo'))
                        <div class="invalid-feedback">{{$errors->first('logo')}}</div>
                    @endif
                </div>
                <div class="row gutters-sm">
                    <div class="col-12">
                        <label class="imagecheck mb-4" for="logo">
                            <figure class="imagecheck-figure">
                                <img src="{{ $logo }}" alt="" class="imagecheck-image" id="imgLogo">
                            </figure>
                        </label>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nội dung</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('logo', 'Logo', array('class' => 'form-label')) }}
                    {{ Form::text('logo', isset($logo)?$logo:null, $attributes = array('class' => 'form-control'.($errors->has('logo')?' is-invalid':''))) }}
                    @if($errors->has('logo'))
                        <div class="invalid-feedback">{{$errors->first('title')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('title', 'Tiêu đề trang', array('class' => 'form-label')) }}
                    {{ Form::text('title', isset($title)?$title:null, $attributes = array('class' => 'form-control'.($errors->has('title')?' is-invalid':''))) }}
                    @if($errors->has('title'))
                        <div class="invalid-feedback">{{$errors->first('title')}}</div>
                    @endif
                </div>
                
                <div class="form-group">
                    {{ Form::label('description', 'Mô tả trang', array('class' => 'form-label')) }}
                    {{ Form::textarea('description', isset($description)?$description:null, $attributes = array('class' => 'form-control'.($errors->has('description')?' is-invalid':''))) }}
                    @if($errors->has('description'))
                        <div class="invalid-feedback">{{$errors->first('description')}}</div>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('slogan', 'Mô tả footer', array('class' => 'form-label')) }}
                    {{ Form::textarea('slogan', isset($slogan)?$slogan:null, $attributes = array('class' => 'form-control'.($errors->has('slogan')?' is-invalid':''))) }}
                    @if($errors->has('slogan'))
                        <div class="invalid-feedback">{{$errors->first('slogan')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('text_footer', 'Text footer', array('class' => 'form-label')) }}
                    {{ Form::text('text_footer', isset($text_footer)?$text_footer:null, $attributes = array('class' => 'form-control'.($errors->has('text_footer')?' is-invalid':''))) }}
                    @if($errors->has('text_footer'))
                        <div class="invalid-feedback">{{$errors->first('text_footer')}}</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Liên hệ</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('email', 'Email', array('class' => 'form-label')) }}
                    {{ Form::text('email', isset($email)?$email:null, $attributes = array('class' => 'form-control'.($errors->has('email')?' is-invalid':''))) }}
                    @if($errors->has('email'))
                        <div class="invalid-feedback">{{$errors->first('email')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('phone', 'Số điện thoại', array('class' => 'form-label')) }}
                    {{ Form::text('phone', isset($phone)?$phone:null, $attributes = array('class' => 'form-control'.($errors->has('phone')?' is-invalid':''))) }}
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('address', 'Địa chỉ', array('class' => 'form-label')) }}
                    {{ Form::text('address', isset($address)?$address:null, $attributes = array('class' => 'form-control'.($errors->has('address')?' is-invalid':''))) }}
                    @if($errors->has('address'))
                        <div class="invalid-feedback">{{$errors->first('address')}}</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Mạng xã hội</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('link_facebook', 'Link facebook', array('class' => 'form-label')) }}
                    {{ Form::text('link_facebook', isset($link_facebook)?$link_facebook:null, $attributes = array('class' => 'form-control'.($errors->has('link_facebook')?' is-invalid':''))) }}
                    @if($errors->has('link_facebook'))
                        <div class="invalid-feedback">{{$errors->first('link_facebook')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('link_youtube', 'Link youtube', array('class' => 'form-label')) }}
                    {{ Form::text('link_youtube', isset($link_youtube)?$link_youtube:null, $attributes = array('class' => 'form-control'.($errors->has('link_youtube')?' is-invalid':''))) }}
                    @if($errors->has('link_youtube'))
                        <div class="invalid-feedback">{{$errors->first('link_youtube')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('link_twitter', 'Link twitter', array('class' => 'form-label')) }}
                    {{ Form::text('link_twitter', isset($link_twitter)?$link_twitter:null, $attributes = array('class' => 'form-control'.($errors->has('link_twitter')?' is-invalid':''))) }}
                    @if($errors->has('link_twitter'))
                        <div class="invalid-feedback">{{$errors->first('link_twitter')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('link_linkedin', 'Link linkedin', array('class' => 'form-label')) }}
                    {{ Form::text('link_linkedin', isset($link_linkedin)?$link_linkedin:null, $attributes = array('class' => 'form-control'.($errors->has('link_linkedin')?' is-invalid':''))) }}
                    @if($errors->has('link_linkedin'))
                        <div class="invalid-feedback">{{$errors->first('link_linkedin')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('link_pinterest', 'Link pinterest', array('class' => 'form-label')) }}
                    {{ Form::text('link_pinterest', isset($link_pinterest)?$link_pinterest:null, $attributes = array('class' => 'form-control'.($errors->has('link_pinterest')?' is-invalid':''))) }}
                    @if($errors->has('link_pinterest'))
                        <div class="invalid-feedback">{{$errors->first('link_pinterest')}}</div>
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
</div>
{{ Form::close() }}
@endsection

@section('jsinline')
<script>
    require(['jquery'], function($) {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#' + $(input).attr('target')).attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $(document).ready(function(){
            $('input[type="file"]').change(function() {
                readURL(this);
            });
        });
    });
</script>
@endsection