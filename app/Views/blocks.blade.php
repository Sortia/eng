@extends('pieces/layout')
@section('content')
    <div class="app-body">
        <section class="todoapp">
            @if(\App\Models\Auth::isAuth())
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
            @endif
        </section>
    </div>
@endsection