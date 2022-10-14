@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Admin Panel</h1>
            @if(Session::has('hide'))
            <p class="alert alert-danger">{{ Session::get('hide') }}</p>
            @elseif (Session::has('show'))
            <p class="alert alert-success">{{ Session::get('show') }}</p>
            @endif

            <table class="table">
                <thead class="bg-primary text-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Deleted At</th>
                        <th scope="col">Hide</th>
                        <th scope="col">Show</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $posts as $post )
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{Str::limit($post->title,'30','.....')}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        <td>
                            @if ($post->deleted_at)
                            {{$post->deleted_at->diffForHumans()}}
                            @endif
                        </td>
                        <td>
                            <form method="post" action="{{ route('admin.post.delete',$post->id) }}">
                            @csrf
                            @method('DELETE')
                            @if ($post->deleted_at)
                                <button type="submit" class="btn btn-danger" disabled>hide</button>
                            @else
                                <button type="submit" class="btn btn-danger">hide</button>
                            @endif
                           
                        </form>
                        </td>
                        <td>
                            <form method="post" action="{{ route('admin.post.restore',$post->id) }}">
                                @csrf
                                @if ($post->deleted_at)
                                <button type="submit" class="btn btn-primary">show</button>
                                @else
                                    <button type="submit" class="btn btn-primary" disabled>show</button>
                                @endif
                               
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination float-left">
                {{$posts->links()}}
            </div>
            
        </div>
    </div>
</div>
@endsection
