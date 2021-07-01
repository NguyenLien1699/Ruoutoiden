@extends('layouts.root')

@section('content_root')
    @include('layouts.header')
    @include('layouts.menu')
    <div class="my-3 my-md-5">
        <div class="container">
            @yield('content')    
        </div>
    </div>
    @include('layouts.footer')
@endsection