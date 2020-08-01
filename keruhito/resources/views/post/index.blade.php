@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>投稿一覧</h2>
        <p><a href="{{ route('post.create') }}" class="btn btn-outline-success">新規追加</a></p>
    
        @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
        @endif
        @foreach ($posts as $post)
        <a href="{{ route('post.show', ['id' => $post->id]) }}">
        <div class="card">
            <div class="card-body">
                <p class="card-title">{{ $post->title }}</p>
                <p class="card-text">{{ $post->content }}</p>
                <p class="card-subtitle">by {{ $post->user->name }}</p>
            </div>
        </div>
        </a>
        @endforeach
        {{ $posts->links() }}
    </div>
@endsection