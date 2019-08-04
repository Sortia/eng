@extends('blocks/layout')
@section('content')

    @if(\App\Models\Auth::isAuth())
        @include('blocks/sidebar')

        <div class="offset-lg-4 col-lg-6 mt-5 pt-5">
            <div class="card">
                <h5 class="card-header">Profile</h5>
                <div class="card-body">

                </div>
            </div>
        </div>

    @endif

@endsection