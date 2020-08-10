@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <h4 class="card-header text-secondary">{{ __('投稿編集') }}</h4>

                <!-- フラッシュメッセージ -->
                @if ($errors->any())
                    <div class="alert alert-danger px-5">
                        <ul class="mb-0 list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('post.update', $post->id ) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right text-secondary">{{ __('選手名') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('email') is-invalid @enderror" name="title" value="{{ $post->title }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right text-secondary">{{ __('紹介文') }}</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror" rows="5" name="content" placeholder="10文字以上140字以内" required>{{ $post->content }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right text-secondary">{{ __('画像') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class = "form-cntrol @error('image') is-invalid @enderror" name="image">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-success">
                                    {{ __('戻る') }}
                                </a>
                                <button type="submit" class="btn btn-outline-success">
                                    {{ __('投稿') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection