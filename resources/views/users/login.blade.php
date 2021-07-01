@extends('layouts.root')

@section('title_page', 'Đăng nhập quản trị')

@section('content_root')
<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    {{ Form::open(array('route' => 'admin.login.get','class' =>"card",'method' => "post")) }}
                        <div class="card-body p-6">
                            <div class="card-title">Đăng nhập quản trị</div>
                            @include('layouts.message.system')
                            <div class="form-group">
                                {{ Form::label('username', 'Username', array('class' => 'form-label')) }}
                                {{ Form::text('username', null, $attributes = array('class' => 'form-control'.($errors->has('username')?' is-invalid':''))) }}
                                @if($errors->has('username'))
                                    <div class="invalid-feedback">{{$errors->first('username')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::label('password', 'Password', array('class' => 'form-label')) }}
                                {{ Form::password('password', $attributes = array('class' => 'form-control'.($errors->has('password')?' is-invalid':''))) }}
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">{{$errors->first('password')}}</div>
                                @endif
                            </div>
                            <div class="form-fsooter">
                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                    <div class="text-center text-muted">
                        Nếu bạn chưa có tài khoản vui lòng liên hệ <a href="javascript:void(0)">Quản trị viên</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection