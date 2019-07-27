@extends('pieces/layout')
@section('content')

    @if(\App\Models\Auth::isAuth())
    @include('pieces/sidebar')



    <div class="offset-lg-5 col-lg-4">
        <section class="todoapp">

                @include('pieces/block')
                @include('pieces/item')

                <div class="todos">
                    <div class="list-footer">
                    <span class="nav-btn">
                        <button id="all">All</button>
                        <button id="active">Active</button>
                        <button id="completed">Completed</button>
                    </span>
                        <span class="clear"><button id="clear">Clear completed</button></span>
                    </div>
                </div>
        </section>
    </div>
    @endif

@endsection