@extends('layouts.template')

@section('title_page', 'Đổi mật khẩu')

@section('content')
<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    {{ Form::open(array('class' =>"card",'method' => "post")) }}
                        <div class="card-body p-6">
                            <div class="card-title">Đổi mật khẩu</div>
                            @include('layouts.message.system')
                            <div class="form-group">
                                {{ Form::label('password_old', 'Mật khẩu cũ', array('class' => 'form-label')) }} 
                                {{ Form::password('password_old', $attributes = array('class' => 'form-control'.($errors->has('password_old')?' is-invalid':''))) }}
                                @if($errors->has('password_old'))
                                    <div class="invalid-feedback">{{$errors->first('password_old')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::label('password_new', 'Mật khẩu mới', array('class' => 'form-label')) }}
                                {{ Form::password('password_new', $attributes = array('class' => 'form-control'.($errors->has('password_new')?' is-invalid':''))) }}
                                @if($errors->has('password_new'))
                                    <div class="invalid-feedback">{{$errors->first('password_new')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::label('password_confirm', 'Xác nhận mật khẩu', array('class' => 'form-label')) }}
                                {{ Form::password('password_confirm', $attributes = array('class' => 'form-control'.($errors->has('password_confirm')?' is-invalid':''))) }}
                                @if($errors->has('password_confirm'))
                                    <div class="invalid-feedback">{{$errors->first('password_confirm')}}</div>
                                @endif
                            </div>
                            <div class="form-fsooter">
                                <button type="submit" class="btn btn-primary btn-block">Đổi mật khẩu</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection