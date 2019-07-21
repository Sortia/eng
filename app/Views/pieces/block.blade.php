<div class="block-page">
    <div class="header">
        <input class="new-todo" id="new-block" placeholder="block_name">
    </div>
    <section class="main">
        <ul class="todo-list block-list">
            @foreach ($blocks as $block)
                <li class="view item-block" value="{{$block['id']}}">
                    <input class="toggle" type="checkbox" {{$block['status'] === '1' ? 'checked' : ''}}>
                    <label class="block">{{$block['name']}}</label>
                    <i class='icon-pencil edit-block'></i>
                    <button class="destroy"></button>
                </li>
            @endforeach
        </ul>
    </section>
</div>