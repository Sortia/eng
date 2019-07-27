@extends('pieces/layout')

@section('content')
    <div class="container mt-3 pt-3">
        <div class="registration-form offset-lg-4 col-lg-4 mt-5">
            <form method="POST" action="/auth/create">
                <div class="form-group">
                    <label for="exampleInputEmail1">Login</label>
                    <input required type="text" class="form-control" id="login" name="login" placeholder="Enter login">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input required type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input required type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input required type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary btn-block float-right">Submit</button>
            </form>
            <a href="/auth/login"><button class="btn btn-primary float-right btn-block mt-3">Log In</button></a>
        </div>
    </div>

    <script>
        let password = document.getElementById("password"),
            confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
            if(password.value !== confirm_password.value) {
                confirm_password.setCustomValidity("Пароли не совпадают.");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
@endsection