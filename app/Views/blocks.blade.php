@extends('pieces/layout')
@section('content')
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
                <span class="clear">
                    <button id="clear">Clear completed</button>
                </span>
            </div>
        </div>

    </section>
@endsection


