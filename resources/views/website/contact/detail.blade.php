@extends('layouts.template')

@section('title_page', $contact->subject)

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-aside">
            <div class="card-body d-flex flex-column">
                <h4><a href="#">{{ $contact->subject }}</a></h4>
                <div class="text-muted">
                    {!! $contact->subject !!}
                </div>
                <div class="d-flex align-items-center pt-5 mt-auto">
                    <div class="avatar avatar-md mr-3" style="background-image: url(/images/avatar_client.png)"></div>
                    <div>
                        <a href="#" class="text-default">{{ $contact->first_name.' '.$contact->last_name }}</a>
                        <small class="d-block text-muted">{{ date('m/d/Y H:i:s', strtotime($contact->created_at)) }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection