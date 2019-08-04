@extends('blocks/layout')

@section('content')
    <div class="container mt-3 pt-3">
        <div class="registration-form offset-lg-4 col-lg-4 mt-5">
            <form method="POST" action="/auth/login">
                <div class="form-group">
                    <label for="exampleInputEmail1">Login</label>
                    <input required type="text" class="form-control" id="login" name="login" placeholder="Enter login">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input required type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary float-right btn-block">Log In</button>
            </form>
            <a href="/auth/register"><button class="btn btn-primary float-right btn-block mt-3">Registration</button></a>
        </div>
    </div>
@endsection