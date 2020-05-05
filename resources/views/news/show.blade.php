@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <h3>{{$news->title}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="float-left">By: <h4>{{$news->author}}</h4></div>
                        <div class="float-right">
                            Published: <h4>{{$news->publishedAt}}</h4>
                        </div>
                        <img class="card-img-top" src="{{$news->imageUrl}}" alt="Card image cap">
                        <div class="text-justify mt-4" style="font-size: large">
                            {{$news->description}}
                            <br><br>
                            {{$news->content}}
                        </div>
                        <a href="{{$news->url}}">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
