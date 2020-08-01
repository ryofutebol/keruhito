@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            </div>
        </div>
    </div>
    <div class="container">
        <h2>投稿一覧</h2>
        <div class="row d-flex pb-3">
            <div class="col-md-6 py-2"><a href="{{ route('post.create') }}" class="btn btn-outline-success">新規追加</a></div>
            <div class="input-group col-md-6 py-2 justify-content-md-end justify-content-start">
                <form action="{{ route('post.search') }}" method="POST" class="col-md-12 d-flex p-0">
                    @csrf
                    <input type="text" name="search" class="form-control" placeholder="検索" aria-label="" aria-describedby="basic-addon1">
                    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    
        <!-- フラッシュメッセージ -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @isset($search_result)
        <h5>{{ $search_result }}</h5>
        @endisset

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