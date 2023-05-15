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
            <form method="POST" action="{{ route('unfollow',$User->id) }}" >
            @csrf
                <button type="submit" class="btn btn-danger">フォロー解除する</button>
        </form>
            <form method="POST" action="{{ route('follow', $User->id)}}" >
        @csrf
            <button type="submit" class="btn btn-primary">フォローする</button>
            </form>

        </td>
    </tr>
</div>
@endforeach


@endsection
