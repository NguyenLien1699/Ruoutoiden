@extends('layouts.template')

@section('title_page', 'Bài viết')

@section('content')
@include('layouts.message.system')
@include('layouts.message.alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead>
                        <tr>
                            <th class="text-center w-1"><i class="icon-people"></i></th>
                            <th>Tài khoản</th>
                            <th>Usage</th>
                            <th class="text-center">Payment</th>
                            <th>Activity</th>
                            <th class="text-center">Satisfaction</th>
                            <th class="text-center"><i class="icon-settings"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection