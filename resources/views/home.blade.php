@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($response as $data )
                <div class="card">
                    <div class="card-header">{{$data->title}}</div>

                    <div class="card-body">
                        <h3>{{$data->description}}</h3>
                        <p>{{$data->content}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
