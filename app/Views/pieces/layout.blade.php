<!doctype html>
<html lang="en" data-framework="jquery">
    <head>
        <meta charset="utf-8">
        <title>ToLearn</title>

        <link rel="stylesheet" href="../../../public/css/libs/bootstrap.min.css">
        <link rel="stylesheet" href="../../../public/css/resets.css">
        <link rel="stylesheet" href="../../../public/css/icons.css">
        <link rel="stylesheet" href="../../../public/css/index.css">
        <link rel="stylesheet" href="../../../public/fonts/fontello-e129e090/css/fontello.css">

        <script src="../../../public/js/libs/jquery-3.3.1.min.js"></script>
        <script src="../../../public/js/libs/bootstrap.min.js"></script>
        <script src="../../../public/js/ajax.js"></script>
        <script src="../../../public/js/app.js"></script>
        <script src="../../../public/js/events.js"></script>
    </head>
    <body>
        @include('pieces/header')
        @yield('content')
    </body>
</html>