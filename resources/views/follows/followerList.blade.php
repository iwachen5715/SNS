@extends('layouts.login')

@section('content')
    <div class="follow-list">
        <h2 class="list-title">フォロワーリスト</h2>
        <div class="icon-container">
    @foreach($follow_icons as $follow_icon)
     <div class="icon-space">
                    <a href="users/{{ $follow_icon->id }}/profile">
                        <img class="icon-size" src="{{ asset('storage/user-images/'. $follow_icon->images) }}" alt="icon">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="line-wrapper"><span class="bold line"></span></div>

    <ul>
       @foreach($posts as $post)<!--繰り返し構文：$postsには自分のフォローしているユーザーの投稿情報が全て入っている-->

             <li>
            <div class="post-container">
                <a href="users/{{ $post->user->id }}/profile" class="icon-space">
                <div class="post-content">
                    <img class="FollowIcon" src="{{ asset('storage/user-images/'. $post->user->images) }}" alt="icon">
                </a>
         <div class="search-group">
               <div class="post-content">
                {{ $post->user->username }}</div>
               <div class="post-content">{{ $post->post }}</div>
         </div>
               <div class="post-content">{{ $post->created_at->format('Y-m-d H:i:s') }}</div>
            </div>


           <div class="thin-wrapper"><span class="line thin"></span></div>
       </li>
       @endforeach
    </ul>
@endsection
