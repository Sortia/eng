<header class="header">
    <h1>ToLearn</h1>
    <input class="new-todo new-eng" id="new-eng" placeholder="block_name" autofocus">
</header>
<section class="main">
    <input id="toggle-all" class="toggle-all" type="checkbox">
    <label for="toggle-all">Mark all as complete</label>
    <ul id="sortable" class="todo-list">


        <?php

        $link = mysqli_connect("127.0.0.1", "root", "", "eng");
        $query = "SELECT * FROM block;";

        $items = mysqli_fetch_all(mysqli_query($link, $query));
        mysqli_close($link);

        foreach ($items as $item) {
            ?>

            <li class="view" value="<?= $item[0] ?>">
                <input class="toggle" type="checkbox" <?= $item[2] === '1' ? 'checked' : '' ?>>
                <label class="hidden rus"><?= $item[1] ?></label>
                <button class="destroy"></button>
            </li>

            <?php
        }
        ?>

    </ul>
</section>