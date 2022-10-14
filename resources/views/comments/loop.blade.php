@foreach($comments as $comment)
<div class="comment mycomments">
    <div class="content-wrapper card">
        @can('delete',$comment)
        <form method="post" action="{{ route('comment.delete',$comment->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn button commentbtn">hide</button>  
        </form>
        @endcan
        
        <div class="card-body">
            <h4>{{ $comment->user->name }}</h4>
            <p>{{$comment->created_at->diffForHumans()}}</p>
            <p>{{ $comment->body }}</p>
            <div class="mt-3">
                <form method="post" action="{{route('comment.replay')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment_body" class="form-control" />
                        <input type="hidden" name="post_id" value="{{ $post_id }}" />
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn button" value="Reply" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="nested-comments-wrapper">
        @include('comments.loop', ['comments' => $comment->replies])
    </div>
    
</div>
@endforeach
