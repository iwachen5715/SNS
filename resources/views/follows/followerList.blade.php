@extends('layouts.login')

@section('content')
    <h1>Follower List</h1> <!--ページの見出しが表示-->
    <ul>
       @foreach($posts as $post)<!--繰り返し構文：$postsには自分のフォローしているユーザーの投稿情報が全て入っている-->
       <p>名前：{{ $post->user->username }}</p>
       <p>投稿内容：{{ $post->post }}</p>
@endforeach

    </ul>
@endsection
