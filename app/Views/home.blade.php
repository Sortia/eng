@extends('blocks/layout')
@section('content')

    @if(\App\Models\Auth::isAuth())
        @include('blocks/sidebar')

        <link rel="stylesheet" href="{{asset('css/home.css')}}">

        <div class="offset-lg-4 col-lg-6 mt-5 pt-5">
            <div class="card">
                <h5 class="card-header">Home</h5>
                <div class="card-body">
                    <ul class="news_list">
                        <li class="warning-hover">
                            <a class="btn btn-block text-left" href="#">First notification</a>
                        </li>
                        <li class="warning-hover">
                            <a class="btn btn-block text-left" href="#">Second notification</a>
                        </li>
                        <li class="warning-hover">
                            <a class="btn btn-block text-left" href="#">Third notification</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    @endif

@endsection