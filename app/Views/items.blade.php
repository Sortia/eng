@extends('blocks/layout')
@section('content')

    @if(\App\Models\Auth::isAuth())

        <script src="{{asset('js/items.js')}}"></script>

        @include('blocks/sidebar')

        <div class="offset-lg-5 col-lg-4">
            <section class="todoapp">

                <div class="item-page">

                    <section class="main">
                        <div class="header">
                            <input class="new-todo new-eng" id="new-eng" placeholder="eng text">
                            <input class="new-todo new-rus" id="new-rus" placeholder="rus text">
                        </div>
                        <ul class="todo-list voc-list">
                            @foreach($items as $item)
                                <li class='view item-item' value='{{$item['id']}}'>
                                    <input class='toggle' type='checkbox' @if($item['status'] == 1) checked @endif>
                                    <label class='active eng'>{{$item['eng']}}</label>
                                    <label class='hidden rus'>{{$item['rus']}}</label>
                                    <i class='icon-pencil edit-item'></i>
                                    <i class='destroy'></i>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                </div>

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