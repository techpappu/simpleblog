<div class="row">
    <div class="col">
        <div class="content_box">
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <h4>Add a comment</h4>
            <form method="post" action="{{route('comment.store')}}">
                @csrf
                <div class="form-group">
                    <input type="text" name="body" class="form-control" />
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn button" value="Submit Comment" />
                </div>
            </form>
        </div>
    </div>
</div>


<div class="row">
    <div class="col">
        @if($errors->any())
            <div class="alert alert-danger myalart">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('replay'))
            <p class="alert alert-success myalart">{{ Session::get('replay') }}</p>
        @endif
        @if(Session::has('deleteComment'))
            <p class="alert alert-success myalart">{{ Session::get('deleteComment') }}</p>
        @endif
        
        @include('comments.loop', ['comments' => $post->comments, 'post_id' => $post->id])
        
    </div>
</div>
