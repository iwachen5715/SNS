@extends('layouts.app')

@section('content')
    <h1>Follower List</h1> <!--ページの見出しが表示-->
    <ul>
       @foreach($posts as $post)
       <p>名前：{{ $post->user->username }}</p>
       <p>投稿内容：{{ $post->post }}</p>
@endforeach
    </ul>
@endsection
