@extends('layouts.template')

@section('title_page', 'Thư liên hệ')

@section('content')
<div class="row">
    <div class="col-12">
        @include('layouts.message.system')
        @include('layouts.message.alert')
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Họ và tên</th>
                            <th>IP</th>
                            <th>Thời gian</th>
                            <th class="text-center"><i class="icon-settings"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($data) && count($data) > 0)
                        @foreach($data as $item)
                            <tr>
                                <td>
                                    <div>
                                        @if(!filter_var($item->is_views, FILTER_VALIDATE_BOOLEAN))
                                            <a href="{{ route('website.contacts.detail', ['id' => $item->id]) }}">
                                                <strong>{{ $item->subject }}</strong>
                                            </a>
                                        @else
                                            <a href="{{ route('website.contacts.detail', ['id' => $item->id]) }}">
                                                {{ $item->subject }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="small text-muted">
                                        {{ $item->email }}
                                    </div>
                                </td>
                                <td> {{ $item->first_name }} {{ $item->last_name }}</td>
                                <td> {{ $item->ip }} </td>
                                <td>
                                    <div class="small text-muted">{{ date('d/m/Y', strtotime($item->created_at)) }}</div>
                                    <div>{{ date('H:i:s', strtotime($item->created_at)) }}</div>
                                </td>
                                <td style=" text-align: right;">
                                    <a href="{{ route('website.contacts.delete',['id' => $item->id]) }}" class="icon"><i class="fe fe-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="5" class="text-center">Không có gì để hiển thị</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if ($data->hasPages())
            {{ $data->appends(request()->input())->links('pagination.default') }}
        @endif
    </div>
</div>
@endsection