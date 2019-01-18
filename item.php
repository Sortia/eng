<header class="header">
    <h1>ToLearn</h1>
    <input class="new-todo new-eng" id="new-eng" placeholder="eng text" autofocus">
    <input class="new-todo new-rus" id="new-rus" placeholder="rus text">
</header>
<section class="main">
    <input id="toggle-all" class="toggle-all" type="checkbox">
    <label for="toggle-all">Mark all as complete</label>
    <ul id="sortable" class="todo-list">


        <?php

        $link = mysqli_connect("127.0.0.1", "root", "", "eng");
        $query = "SELECT * FROM item;";

        $items = mysqli_fetch_all(mysqli_query($link, $query));
        mysqli_close($link);

        foreach ($items as $item) {
            ?>

            <li class="view" value="<?= $item[0] ?>">
                <input class="toggle" type="checkbox" <?= $item[3] === '1' ? 'checked' : '' ?>>
                <label class="active eng"><?= $item[2] ?></label>
                <label class="hidden rus"><?= $item[1] ?></label>
                <button class="destroy"></button>
            </li>

            <?php
        }
        ?>

    </ul>
</section>