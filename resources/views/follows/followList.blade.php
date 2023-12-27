@extends('layouts.login')

@section('content')
    <h2 class="list-title">Follow List</h2>
    @foreach($follow_icons as $follow_icon)
        <tr>
            <td>
                <a href="users/{{ $follow_icon->id }}/profile">
                    <img src="{{ asset('storage/user-images/'. $follow_icon->images) }}" alt="icon" class="icon-space">
                </a>
            </td>
        </tr>
    @endforeach

    <div class="line-wrapper"><span class="bold line"></span></div>

    <ul>
        @foreach($posts as $post)
            <li>
                <a href="users/{{ $post->user->id }}/profile">
                    <img class="FollowIcon" src="{{ asset('storage/user-images/'. $post->user->images) }}" alt="icon">
                </a>

                <p>名前：{{ $post->user->username }}</p>
                <p>投稿内容：{{ $post->post }}</p>
                <div class="thin-wrapper"><span class="line thin"></span></div>
            </li>
        @endforeach
    </ul>
@endsection
