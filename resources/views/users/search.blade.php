@extends('layouts.login')

@section('content')
{!! Form::open(['url' => 'users.search', 'class' => 'post-form']) !!}
{!! Form::input('text', 'searchWord', null, ['required', 'class' => 'search', 'placeholder' => 'ユーザー名']) !!}
<button type="submit"><img src="images/post.png" width="100" height="100"></button>
@if(!empty($searchWord))
<div class="search-word">
    検索ワード:{{ $searchWord}}
</div>
@endif
 {!! Form::close() !!}

 @foreach ($users as $User)
    <p>{{ $User-> username }}</p>
<div>
    <tr>
        <td>
            <img src="storage/{{ $User-> images }}" alt="icon" class="icon-space">
        </td>
        <td>
            {{ $User -> username }}
        </td>
        <td>
            @if(Auth::user()->isFollowing($User->id))
            <form action="{{ route('unfollow',$User->id) }}" method="POST">
            @csrf
                <button type="submit" class="btn btn-danger">フォロー解除する</button>
        </form>
            @else
        <form action="{{ route('follow', $User->id)}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">フォローする</button>
            </form>
            @endif
        </td>
    </tr>
</div>
@endforeach


@endsection
