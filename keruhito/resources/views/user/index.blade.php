@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="card-header d-flex">
                    @if ($user->avatar)
                        <img src="{{ $avatar }}" width="32" height="32">
                    @endif
                    <h4 class="pt-1 pl-1 text-secondary">{{ $user->name }}</h4>
                </div>

                <!-- フラッシュメッセージの表示 -->
				@if (session('success'))
					<div class="alert alert-success">{{ session('success') }}</div>
				@endif

                <div class="card-body">
                    <p class="card-text text-secondary">{{ $user->profile }}</p>
                    @if (Auth::id() == $user->id)
                    <div class="mb-2">
                        <a href="{{ route('user.edit', ['id' => Auth::id()]) }}" class="btn btn-outline-success">編集</a>
                    </div>
                    @endif
                    @if ($user->twitter_id)
                    <a href="https://twitter.com/{{ $user->nickname }}" target="_blank">
                        <p class="card-text text-secondary">
                            <i class="fab fa-twitter"></i>
                            Twitterプロフィールへ
                        </p>
                    </a>
                    @endif
                </div>

            </div>

            <h5 class="text-secondary">投稿数：{{ $posts_count }}件</h5>
            <!-- 投稿一覧 -->
            @foreach ($posts as $post)
            <a href="{{ route('post.show', ['id' => $post->id]) }}">
            <div class="card shadow-sm mb-3">
                <h5 class="card-header text-success">{{ $post->title }}</h5>
                <div class="card-body">
                    <p class="card-text text-secondary">{{ $post->content }}</p>
                    <p class="card-subtitle text-secondary">by {{ $post->user->name }}</p>
                </div>
            </div>
            </a>
            @endforeach

        </div>
    </div>
</div>

@endsection