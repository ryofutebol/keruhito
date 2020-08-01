@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            </div>
        </div>
    </div>
    <div class="container">
        @isset($search_result)
            <h2 class="border-bottom pb-2">検索結果</h2>
        @else
            <h2 class="border-bottom pb-2">ホーム</h2>
        @endisset
        <div class="row d-flex pb-3">
            <div class="col-md-6 py-2"><a href="{{ route('post.create') }}" class="btn btn-outline-success">新規投稿 <i class="fas fa-paper-plane"></i></a></div>
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

        <div class="card-columns border-bottom mb-3">
            @foreach ($posts as $post)
            <a href="{{ route('post.show', ['id' => $post->id]) }}">
            <div class="card shadow-sm">
                <h5 class="card-header text-success">{{ $post->title }}</h5>
                <div class="card-body">
                    <p class="card-text text-secondary">{{ $post->content }}</p>
                    <p class="card-subtitle text-secondary">by {{ $post->user->name }}</p>
                </div>
            </div>
            </a>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">{{ $posts->links('pagination::simple-tailwind') }}</div>
    </div>
@endsection