<div class="flashcard-page">
    <div class="header">
        <input class="new-todo" id="new-flashcard" placeholder="flashcard_name">
    </div>
    <section class="main">
        <ul class="todo-list flashcard-list">
            @foreach ($flashcards as $flashcard)
                <li class="view item-flashcard" value="{{$flashcard['id']}}">
                    <a href="flashcard/{{$flashcard['id']}}">
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