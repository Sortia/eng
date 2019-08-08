@extends('blocks/layout')
@section('content')

    @if(\App\Models\Auth::isAuth())
        @include('blocks/sidebar')

        <link rel="stylesheet" href="{{asset('css/profile.css')}}">
        <script src="{{asset('js/profile.js')}}"></script>

        <div class="offset-lg-4 col-lg-6 mt-5 pt-5">
            <div class="card">
                <h5 class="card-header">Profile</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="profile-image col-lg-5">
                            <img class="col-lg-11 offset-1" src="{{asset('img/' . $user['img'])}}" alt="">
                        </div>
                        <div class="col-lg-7">

                            <form enctype="multipart/form-data" method="POST" action="/profile/update">
                                <fieldset id="profile_fieldset" disabled>
                                    <input type="hidden" name="id" class="form-control" value="{{$user['id']}}" required>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Login</span>
                                        </div>
                                        <input type="text" aria-label="Login" name="login" class="form-control" value="{{$user['login']}}" required>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">First name</span>
                                        </div>
                                        <input type="text" aria-label="First name" name="first_name" class="form-control" value="{{$user['first_name']}}" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Last name</span>
                                        </div>
                                        <input type="text" aria-label="Last name" name="last_name" class="form-control" value="{{$user['last_name']}}" required>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">E-mail</span>
                                        </div>
                                        <input type="text" aria-label="Last name" name="email" class="form-control" value="{{$user['email']}}" required>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class=" btn-file input-group-text">
                                               Upload image <input name="img" type="file" id="imgInp">
                                            </span>
                                        </div>
                                        <input aria-label="Upload image" id="img_name" type="text" class="form-control" readonly>
                                    </div>

                                    <div id="change_pass_block" style="display: none">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Old password</span>
                                            </div>
                                            <input name="old_password" id="old_password" type="password" aria-label="Old password" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">New password</span>
                                            </div>
                                            <input name="new_password" id="new_password" type="password" aria-label="New password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <button id="change_pass_btn" class="btn btn-outline-primary btn-block">Change password</button>
                                    </div>
                                </fieldset>

                                <button id="profile_edit_btn" class="btn btn-primary btn-block col-lg-3 float-lg-right" type="submit">Edit</button>
                                <button id="profile_save_btn" class="mt-0 btn btn-success btn-block col-lg-3 float-lg-right" type="submit" style="display: none">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection