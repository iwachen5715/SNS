@extends('layouts.login')

@section('content')
    <div class="follow-list">
        <h2 class="list-title">Follower List</h2>
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
           <p>名前：{{ $post->user->username }}</p>
           <p>投稿内容：{{ $post->post }}</p>
           <div class="thin-wrapper"><span class="line thin"></span></div>
       </li>
       @endforeach
    </ul>
@endsection

<!-- @section('content')
    <div class="follow-list">
        <h2 class="list-title">Follow List</h2>
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
        @foreach($posts as $post)
            <li>
                <a href="users/{{ $post->user->id }}/profile" class="icon-space">
                    <img class="FollowIcon" src="{{ asset('storage/user-images/'. $post->user->images) }}" alt="icon">
                </a>

                <p>名前：{{ $post->user->username }}</p>
                <p>投稿内容：{{ $post->post }}</p>
                <div class="thin-wrapper"><span class="line thin"></span></div>
            </li>
        @endforeach
    </ul>
@endsection -->
