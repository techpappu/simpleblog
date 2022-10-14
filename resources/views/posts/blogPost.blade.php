@extends('layouts.app')

@section('content')
<div class="container main_container">
    <div class="row heading_row">
        <div class="col">
           <h2>Post Details</h2>
        </div>
        <div class="col">
            @can('edit',$post)
            <a class="btn" href="{{route('post.edit',$post->id)}}">edit</a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="content_box">
                <h1>{{$post->title}} </h1>
                <p>{{$post->body}}</p>
            </div>
            
           
        </div>
        
    </div>

    @include('comments.form')
 


</div>

@endsection
