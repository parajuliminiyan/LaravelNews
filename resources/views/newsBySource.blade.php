@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($response as $data )
                <div class="card">
                    <div class="card-header">{{$data->title}}</div>

                    <div class="card-body">
                        <img class="card-img-top" src="{{$data->urlToImage}}" alt="Card image cap">
                        <p>{{$data->content}}</p>
                    </div>
                </div><br>
            @endforeach
        </div>
    </div>
</div>
@endsection
