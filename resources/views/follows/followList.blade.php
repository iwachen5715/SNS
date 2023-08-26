@extends('layouts.login')

@section('content')
    <h1>Follow List</h1>
    <ul>
       @foreach($posts as $post)
         <p>名前：{{ $post->user->username }}</p>
         <p>投稿内容：{{ $post->post }}</p>
       @endforeach
    </ul>
@endsection
