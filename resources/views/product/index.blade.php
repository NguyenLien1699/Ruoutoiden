@extends('layouts.template')

@section('title_page', 'Sản phẩm')

@section('content')
@include('layouts.message.system')
@include('layouts.message.alert')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách sản phẩm</h3>
                <div class="card-options">
                    <a href="{{ route('website.product.create') }}" class="btn btn-primary btn-sm">Thêm sản phẩm</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead>
                        <tr>
                            <th style="text-align: left !important;">#</th>
                            <th>Tên sản phẩm</th>
                            <th>Lượt xem</th>
                            <th>Ngày tạo</th>
                            <th class="text-right">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($data) && count($data) > 0)
                            @foreach($data as $item)
                                <tr>
                                    <td style="width: 1%;"><span class="text-muted">#{{ $item->id }}</span></td>
                                    <td>
                                        <div>{{ Illuminate\Support\Str::limit($item->title, 100, '...') }}</div>
                                        <div class="small text-muted">{{ Illuminate\Support\Str::limit($item->slug, 100, '...') }}</div>
                                    </td>
                                    <td>{{ number_format($item->view) }}</td>
                                    <td>
                                        <div class="small text-muted">{{ date('d/m/Y', strtotime($item->updated_at)) }}</div>
                                        <div>{{ date('H:i:s', strtotime($item->updated_at)) }}</div>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('website.product.edit',['id' => $item->id]) }}" class="btn btn-sm btn-secondary">
                                            <span class="fe fe-edit-2"></span>
                                        </a>
                                        <a href="{{ route('website.product.delete',['id' => $item->id]) }}" class="btn btn-sm btn-secondary">
                                            <span class="fe fe-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <tr><td class="text-center" colspan="5">Không có gì để hiển thị</td></td>
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