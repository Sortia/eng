@extends('blocks/layout')
@section('content')

    @if(\App\Models\Auth::isAuth())
        @include('blocks/sidebar')

        <div class="offset-lg-4 col-lg-6 mt-5 pt-5">
            <div class="card">
                <h5 class="card-header">Settings</h5>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Language</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>English</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Theme</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Default</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Notification</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Default</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection