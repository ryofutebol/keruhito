@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="card-header d-flex justify-content-between">
                    <h4 class="pt-2">{{ __('投稿詳細') }}</h4>
                    @if(Auth::user()->id == $post->user_id)
                    <div>
                        <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-outline-primary">編集</a>
                        <a href="{{ route('post.destroy', ['id' => $post->id]) }}" class="btn btn-outline-danger">削除</a>
                    </div>
                    @endif
                </div>

                <!-- フラッシュメッセージの表示 -->
				@if (session('success'))
					<div class="alert alert-success">{{ session('success') }}</div>
				@endif

                <div class="card-body">
                    <p class="card-title">{{ $post->title }}</p>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                <img src="{{ asset('storage/images/' . $post->image) }}" alt="Card image" height=80% width=80%>
                <div class="card-body">
                    <p class="card-subtitle">by {{ $post->user->name }}</p>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection