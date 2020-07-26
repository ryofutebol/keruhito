@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>投稿一覧</h2>
        <p><a href="{{ route('post.create') }}" class="btn btn-outline-success">新規追加</a></p>
    
        @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
        @endif
        @foreach ($posts as $post)
        <div class="card">
            <div class="card-body">
                <p class="card-title">{{ $post->title }}</p>
            </div>
            <img src="/images/pathToYourImage.png" alt="Card image">
            <div class="card-body">
                <p class="card-text">by User</p>
            </div>
        </div>
        @endforeach
    </div>
@endsection