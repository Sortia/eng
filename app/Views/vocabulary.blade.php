@extends('pieces/layout')
@section('content')

    @if(\App\Models\Auth::isAuth())
        @include('pieces/sidebar')


        <div class="offset-lg-4 col-lg-6 mt-5 pt-5">
            <div class="card">
                <h5 class="card-header">Vocabulary</h5>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">English</th>
                            <th scope="col">Russian</th>
                            <th scope="col">Flashcard</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($items as $index => $item)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$item['eng']}}</td>
                                <td>{{$item['rus']}}</td>
                                <td>{{$item['block_name']}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endif

@endsection