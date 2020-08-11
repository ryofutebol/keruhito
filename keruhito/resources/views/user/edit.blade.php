@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <h4 class="card-header text-secondary">{{ __('プロフィール編集') }}</h4>

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
                    <form method="POST" action="{{ route('user.update', Auth::id()) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-secondary">{{ __('名前') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile" class="col-md-4 col-form-label text-md-right text-secondary">{{ __('プロフィール') }}</label>

                            <div class="col-md-6">
                                <textarea id="profile" class="form-control @error('profile') is-invalid @enderror" rows="5" name="profile" placeholder="">{{ $user->profile }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{ route('user.index', ['id' => Auth::id()]) }}" class="btn btn-success">
                                    {{ __('戻る') }}
                                </a>
                                <button type="submit" class="btn btn-outline-success">
                                    {{ __('編集') }}
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