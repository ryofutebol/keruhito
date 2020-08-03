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
                    <h4 class="pt-2 text-secondary">{{ $post->title }}</h4>
                    @if(Auth::user()->id == $post->user_id)
                        <div>
                            <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-outline-success">編集 <i class="fas fa-edit"></i></a>
                            <a href="{{ route('post.destroy', ['id' => $post->id]) }}" class="btn btn-outline-danger">削除 <i class="fas fa-trash-alt"></i></a>
                        </div>
                    @endif
                </div>

                <!-- フラッシュメッセージの表示 -->
				@if (session('success'))
					<div class="alert alert-success">{{ session('success') }}</div>
				@endif

                <div class="card-body">
                    <p class="card-text text-secondary">{{ $post->content }}</p>
                </div>
                <img src="{{ asset('storage/images/' . $post->image) }}" alt="Card image" height=70% width=70% class="mx-auto d-block">
                <div class="card-body">
                    <p class="card-subtitle text-secondary pb-1">by {{ $post->user->name }}</p>
                    <p class="card-subtitle text-secondary">at {{ $post->created_at }}</p>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection