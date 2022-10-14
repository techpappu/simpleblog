@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Edit your Post</h1>
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <form method="post" action="{{ route('post.update',$post->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title"><b>Title</b></label>
                    <input type="text" value="{{$post->title}}" class="form-control" name="title" id="title" placeholder="Enter title here">
                    <small id="emailHelp" class="form-text text-muted">enter your title here.</small>
                </div>
                <div class="form-group mt-3">
                    <label for="body">Post Content</label>
                    <textarea class="form-control" name="body" id="body" rows="8">{{$post->body}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-5">update</button>
            </form>
        </div>
    </div>
</div>

@endsection
