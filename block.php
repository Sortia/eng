<div class="block-page">
    <header class="header">
        <h1>ToLearn</h1>
        <input class="new-todo new-eng" id="new-eng" placeholder="block_name" autofocus">
    </header>
    <section class="main">
        <ul id="sortable" class="todo-list block-list">

            <?php

            $link = mysqli_connect("127.0.0.1", "root", "", "eng");
            $query = "SELECT * FROM block;";

            $items = mysqli_fetch_all(mysqli_query($link, $query));
            mysqli_close($link);

            foreach ($items as $item) {
                ?>
                <li class="view item-block" value="<?= $item[0] ?>">
                    <input class="toggle" type="checkbox" <?= $item[2] === '1' ? 'checked' : '' ?>>
                    <label class="block"><?= $item[1] ?></label>
                    <button class="destroy"></button>
                </li>
            <?php
            }
            ?>

        </ul>
    </section>
</div>