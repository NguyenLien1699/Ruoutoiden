<section class="ftco-section contact-section ftco-no-pb" id="contact-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Liên hệ</span>
                <h2 class="mb-4">Liên hệ với chúng tôi</h2>
                <p>Hãy liên hệ với chúng tôi khi bạn cần.</p>
            </div>
        </div>
        <div class="row d-flex contact-info mb-5">
            <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="icon-map-signs"></span>
                    </div>
                    <h3 class="mb-4">Địa chỉ</h3>
                    <p>{{ $setting->address }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="icon-phone2"></span>
                    </div>
                    <h3 class="mb-4">Số điện thoại</h3>
                    <p>{{ $setting->phone }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="icon-paper-plane"></span>
                    </div>
                    <h3 class="mb-4">Email</h3>
                    <p>{{ $setting->email }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="icon-globe"></span>
                    </div>
                    <h3 class="mb-4">Website</h3>
                    <p>{{ config('app.url') }}</p>
                </div>
            </div>
        </div>
        <div class="row no-gutters block-9">
            <div class="col-md-6 order-md-last d-flex">
                {{ Form::open(array('route' => 'website.contact','class' =>"bg-light p-5 contact-form",'method' => "post")) }}
                    @include('message.alert')
                    <div class="form-group row">
                        <div class="col-md-6">
                            {{ Form::text('fname', null, $attributes = array('class' => 'form-control', 'placeholder' => 'Họ và tên lót')) }}
                            @if($errors->has('fname'))
                                <div class="invalid-feedback">{{$errors->first('fname')}}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {{ Form::text('lname', null, $attributes = array('class' => 'form-control', 'placeholder' => 'Tên')) }}
                            @if($errors->has('lname'))
                                <div class="invalid-feedback">{{$errors->first('lname')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::text('email', null, $attributes = array('class' => 'form-control', 'placeholder' => 'Email')) }}
                        @if($errors->has('email'))
                            <div class="invalid-feedback">{{$errors->first('email')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::text('subject', null, $attributes = array('class' => 'form-control', 'placeholder' => 'Tiêu đề')) }}
                        @if($errors->has('subject'))
                            <div class="invalid-feedback">{{$errors->first('subject')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::textarea('message',null,['class'=>'form-control', 'rows' => 7, 'cols' => 30, 'placeholder' => "Nội dung"]) !!}
                        @if($errors->has('message'))
                            <div class="invalid-feedback">{{$errors->first('message')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Gửi thư" class="btn btn-primary py-3 px-5">
                    </div>
                {{ Form::close() }}
            </div>
            <div class="col-md-6 d-flex">
                <div id="map" class="bg-white"></div>
            </div>
        </div>
    </div>
</section>