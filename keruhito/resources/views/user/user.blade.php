@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="card-header d-flex justify-content-between">
                    <h4 class="pt-2 text-secondary">{{ $user->name }}</h4>
                    @if(Auth::user()->id == $post->user_id)
                        <div>
                            <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-outline-success">編集</a>
                            <a href="{{ route('post.destroy', ['id' => $post->id]) }}" class="btn btn-outline-danger">削除</a>
                        </div>
                    @endif
                </div>

                <!-- フラッシュメッセージの表示 -->
				@if (session('success'))
					<div class="alert alert-success">{{ session('success') }}</div>
				@endif

                <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Card image" height=80% width=80% class="mx-auto d-block">
                <div class="card-body">
                    <a href=""><p class="card-text text-secondary">Twitterプロフィールへ</p></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection