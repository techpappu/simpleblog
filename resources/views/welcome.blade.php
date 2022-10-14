@extends('layouts.app')

@section('content')
<div class="container main_container">
    <div class="row heading_row">
        <div class="col">
           <h2>All Post page</h2>
        </div>
        <div class="col">
            @auth
                <a class="btn" href="{{route('post.create')}}">Add New</a>
            @endauth
        </div>
    </div>
    <div class="row">
        <div class="col">
            @foreach ( $posts as $post)
            <div class="content_box">
                <h1>{{$post->title}} </h1>
                <p>{{Str::limit($post->body,'50','.....')}}</p>
                <div class="meta_box">
                    Created By <b>{{$post->user->name}} </b> {{$post->created_at->diffForHumans()}}
                </div> 
                <div class="readmore">
                    <a class="btn" href="{{route('post.show',$post->id)}}">Read More</a>
                </div> 
            </div>
            @endforeach
            
           
        </div>
        
    </div>
    <div class="row">
        <div class="col">
            <div class="pagiantion">
                {{$posts->links()}}
            </div>
            
        </div>
    </div>


</div>

@endsection
