@extends('layouts.login')

@section('content')

<div>
  <div class="icon-flex">
    <!-- $usersは、、アイコンユーザーのユーザー情報(UsersController@profileで取ってきている) -->
    <!--  アイコン、ユーザー名、自己紹介文を画面に表示する-->

    <!-- アイコン表示 とりあえず、icon1.pngを表示-->


    @if( $user->images == 'icon1.png' )

    <a href="/profile/{{ $user->id}}/view">
      <figure>
        <img class="top-img" src="{{ asset('images/'.$user->images)}}" alt="アイコン">
      </figure>
    </a>

    @else
    <!-- icon1でなければ、 -->
    <a href="/profile/{{ $user->id}}/view">
      <figure>
        <img class="top-img" src="{{ asset('storage/images/'.$user->images)}}" alt="アイコン">
      </figure>
    </a>
    @endif

    <div class="content-flex">
      <div class="name-flex">
        <div class="name1">ユーザー名</div>
        <div class="user-name">{{ $user->username }}</div>
      </div><div class="bio-flex">
        <div class="bio-title">自己紹介</div>
        <div class="bio-post">{{ $user->bio }}</div>
        <!-- <div>{{ $user-> bio}}</div> -->
        <!-- 入力できるようになると表示される -->
      </div>


    </div>

    <!-- ログインユーザーでなければ「フォローする」or「フォロー解除」ボタンを表示する -->
    <div class="btn_box">
      @if(!(Auth::user()== $user ))
      @if(Auth()->user()->isFollowing($user->id))
      <div class="unfollow_btn">
        <button type="submit" class="btn_profile unfollow">
          <a href="/profile/{{ $user->id }}/unfollow">フォロー解除</a>

        </button>
      </div>
      @else
      <div class="follow_btn">
        <button type="submit" class="btn_profile follow">
          <a href="/profile/{{ $user->id }}/follow">フォローする</a>
        </button>
      </div>
      @endif
      @endif
    </div>
  </div>

  <div class="gray-line"></div>

  @foreach($posts as $post)
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



</div>

@endsection
