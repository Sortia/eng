@extends('blocks/layout')
@section('content')

    @if(\App\Models\Auth::isAuth())

        <script src="{{asset('js/flashcards.js')}}"></script>

        @include('blocks/sidebar')

        <div class="offset-lg-5 col-lg-4 mt-5 pt-5">
            <section class="todoapp">

                <div class="flashcard-page">
                    <div class="header">
                        <input class="new-todo" id="new-flashcard" placeholder="flashcard_name">
                    </div>
                    <section class="main">
                        <ul class="todo-list flashcard-list">
                            @foreach ($flashcards as $flashcard)
                                <li class="view item-flashcard" value="{{$flashcard['id']}}">
                                    <a href="items/{{$flashcard['id']}}">
                                        <input class="toggle" type="checkbox" {{$flashcard['status'] === '1' ? 'checked' : ''}}>
                                        <label class="flashcard">{{$flashcard['name']}}</label>
                                        <i class='icon-pencil edit-flashcard'></i>
                                        <i class="destroy"></i>
                                    </a>
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