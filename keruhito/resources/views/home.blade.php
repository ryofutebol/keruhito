@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="top-bg">
    <div class="jumbotron p-4 p-sm-5">
        <h1 class="display-4">Keruhito</h1>
        <p class="lead">自分の好きなサッカー選手をシェアしよう！「あのドリブルは真似できない！」「闘志溢れるディフェンスに惹かれる！」「チームを纏めるチャプテンシーが素敵！」などサッカーに通づる人だから共感できる、ちょっとマニアックなサッカー選手のことをシェアするサイト</p>
        <hr class="my-2">
        <p>Twitterと連携しているのでこのサイトでシェアしたこともTwitterに投稿することも可能</p>
        <p class="lead">
            <a class="btn btn-outline-primary btn-md " href="{{ route('login') }}" role="button">ログインして投稿する</a>
            <a class="btn btn-outline-primary btn-md" href="{{ route('post.index') }}" role="button">ホームへ</a>
        </p>
    </div>
</div>
@endsection
