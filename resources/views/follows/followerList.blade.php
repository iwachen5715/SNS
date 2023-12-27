@extends('layouts.login')

@section('content')
    <h1>Follower List</h1> <!--ページの見出しが表示-->
    @foreach($follow_icons as $follow_icon)
    <tr>
      <td>
         <a href="users/{{ $follow_icon->id }}/profile">
          <img class="FollowerIcon" src="{{ asset('storage/user-images/'. Auth::user()->images) }}" alt="icon" class="icon-space">
        </a>
        <!-- <a href="users/{{ $follow_icon->id }}/profile">
          <img class="FollowerIcon" src="{{ asset('storage/user-images/'. Auth::user()->images) }}" alt="icon" class="icon-space">
        </a> -->
      </td>
    </tr>
    @endforeach

    <div class="line-wrapper"><span class="bold line"></span></div>

    <ul>
       @foreach($posts as $post)<!--繰り返し構文：$postsには自分のフォローしているユーザーの投稿情報が全て入っている-->
       <li>
           <p>名前：{{ $post->user->username }}</p>
           <p>投稿内容：{{ $post->post }}</p>
           <div class="thin-wrapper"><span class="line thin"></span></div>
       </li>
       @endforeach
    </ul>
@endsection
