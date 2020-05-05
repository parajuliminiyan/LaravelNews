@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($response as $data )
                    <div class="card">
                        <div class="card-body">
                            <a href="/news/{{$data->id}}/details">
                                {{$data->title}}
                            </a>
                        </div>

                    </div><br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
