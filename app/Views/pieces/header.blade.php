<link rel="stylesheet" href="/public/css/header.css">

<header class="header p-2">
    <div class="vertical-align">
        <div class="col-lg-2">
            <a href="/"><div class="logo h3 text-white ml-3">ToLearn</div></a>
        </div>
        <div class="col-lg-2 text-white offset-lg-8">
            @if(auth())
                <a href="/auth/logout"><div class="text-while h6 float-right mr-3">Logout</div></a>
            @else
                <a href="/auth/login"><div class="text-while h6 float-right mr-3">Login</div></a>
            @endif
        </div>

    </div>
</header>