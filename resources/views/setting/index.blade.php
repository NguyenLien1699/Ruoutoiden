@extends('layouts.template')

@section('title_page', 'Cài đặt')

@section('content')
<div class="col-12">
{{ Form::open(array('class' =>"card",'method' => "post")) }}
<div class="card-header">
    <h3 class="card-title">Cài đặt</h3>
</div>
<div class="card-body">
    @include('layouts.message.system')
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="form-group">
                {{ Form::label('name_company_excel', 'Bên A', array('class' => 'form-label')) }}
                {{ Form::text('name_company_excel', request()->name_company_excel ?? $name_company_excel, $attributes = array('class' => 'form-control'.($errors->has('name_company_excel')?' is-invalid':''))) }}
                @if($errors->has('name_company_excel'))
                    <div class="invalid-feedback">{{$errors->first('name_company_excel')}}</div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('email_excel', 'Email', array('class' => 'form-label')) }}
                {{ Form::text('email_excel', request()->email_excel ?? $email_excel, $attributes = array('class' => 'form-control'.($errors->has('email_excel')?' is-invalid':''))) }}
                @if($errors->has('email_excel'))
                    <div class="invalid-feedback">{{$errors->first('email_excel')}}</div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('represent_excel', 'Đại diện', array('class' => 'form-label')) }}
                {{ Form::text('represent_excel', request()->represent_excel ?? $represent_excel, $attributes = array('class' => 'form-control'.($errors->has('represent_excel')?' is-invalid':''))) }}
                @if($errors->has('represent_excel'))
                    <div class="invalid-feedback">{{$errors->first('represent_excel')}}</div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('position_excel', 'Chức vụ', array('class' => 'form-label')) }}
                {{ Form::text('position_excel', request()->position_excel ?? $position_excel, $attributes = array('class' => 'form-control'.($errors->has('position_excel')?' is-invalid':''))) }}
                @if($errors->has('position_excel'))
                    <div class="invalid-feedback">{{$errors->first('position_excel')}}</div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('us_tax', 'Thuế mỹ', array('class' => 'form-label')) }}
                {{ Form::number('us_tax', request()->us_tax ?? $us_tax, $attributes = array('class' => 'form-control'.($errors->has('us_tax')?' is-invalid':''))) }}
                @if($errors->has('us_tax'))
                    <div class="invalid-feedback">{{$errors->first('us_tax')}}</div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('vietnam_tax', 'Thuế việt nam', array('class' => 'form-label')) }}
                {{ Form::number('vietnam_tax', request()->vietnam_tax ?? $vietnam_tax, $attributes = array('class' => 'form-control'.($errors->has('vietnam_tax')?' is-invalid':''))) }}
                @if($errors->has('vietnam_tax'))
                    <div class="invalid-feedback">{{$errors->first('vietnam_tax')}}</div>
                @endif
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="form-group">
                {{ Form::label('phone_excel', 'Số điện thoại', array('class' => 'form-label')) }}
                {{ Form::text('phone_excel', request()->phone_excel ?? $phone_excel, $attributes = array('class' => 'form-control'.($errors->has('phone_excel')?' is-invalid':''))) }}
                @if($errors->has('phone_excel'))
                    <div class="invalid-feedback">{{$errors->first('phone_excel')}}</div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('exchange_rate', 'Tỷ giá', array('class' => 'form-label')) }}
                {{ Form::number('exchange_rate', request()->exchange_rate ?? $exchange_rate, $attributes = array('class' => 'form-control'.($errors->has('exchange_rate')?' is-invalid':''))) }}
                @if($errors->has('exchange_rate'))
                    <div class="invalid-feedback">{{$errors->first('exchange_rate')}}</div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('address_excel', 'Địa chỉ', array('class' => 'form-label')) }}
                {{ Form::textarea('address_excel', request()->address_excel ?? $address_excel, $attributes = array('class' => 'form-control'.($errors->has('address_excel')?' is-invalid':''))) }}
                @if($errors->has('address_excel'))
                    <div class="invalid-feedback">{{$errors->first('address_excel')}}</div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="card-footer text-right">
    <button type="submit" class="btn btn-primary ml-auto">Lưu dữ liệu</button>
</div>
{{ Form::close() }}
</div>
@endsection