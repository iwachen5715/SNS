@extends('layouts.login')

@section('content')
    {!! Form::open(['url' => '/search', 'class' => 'post-form']) !!}
    {!! Form::input('text', 'searchWord', null, ['required', 'class' => 'search', 'placeholder' => 'ユーザー名']) !!}
    <button type="submit"><img src="images/post.png" width="12" height="12"></button>
    <!-- <button type="submit" class="Send-btn"><img class="upload" src="images/post.png"></button> -->
    {!! Form::close() !!}

    @if (!empty($searchWord))
        <div class="search-word">
            検索ワード: {{ $searchWord }}
        </div>
    @endif

     <div class="line search-wrapper"><span class="bold search-line"></span></div>

    @foreach ($users as $user)
       <div>
            <tr>
                <td>
                    <img src="{{ asset('storage/user-images/'. $user->images) }}" alt="icon" class="icon-spaces">
                </td>
                <td>
                    {{ $user->username }}
                </td>
                <td>
                    @if(auth()->user()->isFollowing($user->id))
                            <p class="btn btn-danger"><a href="{{ route('unfollow', ['id'=>$user->id]) }}">フォロー解除</a></p>
                    @else
                            <p class="btn btn-primary"><a href="{{ route('follow', ['id'=>$user->id]) }}">フォローする</a></p>
                        <!-- aタグにする理由としてURLでパラメーターを送るときはaタグで送りたいため-->
                    @endif
                </td>
            </tr>
        </div>
    @endforeach
@endsection
