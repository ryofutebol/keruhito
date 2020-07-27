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
                <div class="card-header">{{ __('投稿詳細') }}</div>

                <div class="card-body">
                    <p class="card-title">{{ $post->title }}</p>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                <img src="/images/pathToYourImage.png" alt="Card image">
                <div class="card-body">
                    <p class="card-subtitle">by User</p>
                </div>
                <div>
                    <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-primary">編集</a>
                    <a href="{{ route('post.destroy', ['id' => $post->id]) }}" class="btn btn-danger">削除</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection