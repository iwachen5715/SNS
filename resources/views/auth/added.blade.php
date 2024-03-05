@extends('layouts.logout')

@section('content')
<div class="login-form">

  <p class="hello">{{ session('username') }}さん</p>
  <p class="hello">ようこそ！AtlasSNSへ</p>

  <p class="hello-added">ユーザー登録が完了いたしました。</p>
  <p class="hello-added-2">早速ログインをしてみましょう！</p>

  <!-- <p><a href="/login" class="">ログイン画面へ</a></p> -->
  <!-- <a href="/login" class="btn login-btn">ログイン画面へ</a> -->
  <div class="added-box">
    <a href="/login" class="btn--red">ログイン画面へ</a>
  </div>
</div>

@endsection
