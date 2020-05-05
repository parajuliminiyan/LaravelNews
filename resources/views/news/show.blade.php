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
                        <div class="col-md-12">
                            <div class="float-left">By: <h4>{{$news->author}}</h4> </div>
                            <div class="float-right">
                                Published: <h4>{{$news->publishedAt}}</h4>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-2">
                            @guest()
                                <button class="btn btn-outline-primary" type="submit" disabled >
                                    <i class="fa fa-thumbs-up"></i> {{$news->countLike($news->id)}}
                                </button>
                                <button class="btn btn-outline-primary" type="submit" disabled>
                                    <i class="fa fa-thumbs-down"></i> {{count($news->getDislikes())}}
                                </button>
                            @else
                                <form action="{{route('likeNews',['id'=>$news->id])}}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-primary" type="submit"  >
                                        <i class="fa fa-thumbs-up"></i> {{count($news->getLikes())}}
                                    </button>
                                </form>
                                <form action="{{route('dislikeNews',['id'=>$news->id])}}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="fa fa-thumbs-down"></i> {{count($news->getDislikes())}}
                                    </button>
                                </form>
                            @endguest
                        </div>
                        <img class="card-img-top" src="{{$news->imageUrl}}" alt="Card image cap">
                        <div class="text-justify mt-4 mb-5" style="font-size: large">
                            {{$news->description}}
                            <br><br>
                            {{$news->content}}
                        </div>
                        <div class="float-right" style="font-size: medium; color: #2ecc71">Source: {{ucwords($news->source)}}</div>
                        <a href="{{$news->url}}">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
