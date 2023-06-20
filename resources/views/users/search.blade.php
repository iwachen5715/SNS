@extends('layouts.login')

@section('content')
    {!! Form::open(['url' => 'users.search', 'class' => 'post-form']) !!}
    {!! Form::input('text', 'searchWord', null, ['required', 'class' => 'search', 'placeholder' => 'ユーザー名']) !!}
    <button type="submit"><img src="images/post.png" width="100" height="100"></button>
    {!! Form::close() !!}

    @if (!empty($searchWord))
        <div class="search-word">
            検索ワード: {{ $searchWord }}
        </div>
    @endif

    @foreach ($users as $user)
        <p>{{ $user->username }}</p>
       <div>
            <tr>
                <td>
                    <img src="{{ asset('storage/' ,$user->images) }}" alt="icon" class="icon-space">
                </td>
                <td>
                    {{ $user->username }}
                </td>
                <td>
                    @if(auth()->user()->isFollowing($user->id))
                        <form action="{{ route('unfollow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">フォロー解除する</button>
                        </form>
                    @else
                        <form action="" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">フォローする</button>
                        </form>
                        <a href="{{ route('follow', ['id'=>$user->id]) }}">フォローする<</a>
                        <!-- aタグにする理由としてURLでパラメーターを送るときはaタグで送りたいため-->
                    @endif
                </td>
            </tr>
        </div>
    @endforeach
@endsection
