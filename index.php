<!doctype html>
<html lang="en" data-framework="jquery">
<head>
    <meta charset="utf-8">
    <title>ToLearn</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<section class="todoapp">
    <?php
        require_once 'sup_functions.php';
        require_once 'block.php';
        require_once 'item.php';
    ?>

    <div class="todos">
        <div class="list-footer">
<!--            <span class="count">5 left</span>-->
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

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/app.js"></script>
<script src="js/jquery-ui.min.js"></script>

</body>
</html>
