<div class="block-page">
    <header class="header">
        <h1>ToLearn</h1>
        <input class="new-todo" id="new-block" placeholder="block_name">
    </header>
    <section class="main">
        <ul class="todo-list block-list">
            @foreach ($blocks as $block)
                <li class="view item-block" value="{{$block[0]}}">
                    <input class="toggle" type="checkbox" {{$block[2] === '1' ? 'checked' : ''}}>
                    <label class="block">{{$block[1]}}</label>
                    <button class="destroy"></button>
                </li>
            @endforeach
        </ul>
    </section>
</div>