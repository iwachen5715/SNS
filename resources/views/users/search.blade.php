@extends('layouts.login')

@section('content')
   <!-- ユーザー検索フォーム表示-->


<div class="search-top-flex">
  <div>
    <!-- 検索フォーム -->
    <form action="/search" method="post" class="search-form-001">
      @csrf
      <input type="search" name="searchWord" class="form" placeholder="ユーザー名" value="@if(isset($keyword)){{ $keyword }}@endif">
      <!-- もしキーワードが入力されていたら、キーワードを表示する。前の検索を残すため。 -->
      <input type="image" src="{{ asset('images/search.png') }}" class="search_btn" alt="検索ボタン"></input>
      <!-- 検索ボタン -->
    </form>
  </div>
  <!-- 検索ワードの表示 -->
  <!-- 検索ワードに入力していた場合、検索ワードを表示する -->
  <div class="keyword-box">
    @if(!empty($searchWord))
    <p class="keyword">検索ワード：{{$searchWord}}</p>
    @endif
  </div>
</div>

    <div class="gray-line"></div>


@foreach ($users as $user)
    @if($user->id !== auth()->id()) <!-- ここでログインユーザーのIDと比較 -->
       <div class="user-row">
        <img src="{{ asset('storage/user-images/'. $user->images) }}" alt="icon" class="icon-spaces">
        <span>{{ $user->username }}</span>
        <span>
            @if(auth()->user()->isFollowing($user->id))
                <p class="btn btn-danger"><a href="{{ route('unfollow', ['id'=>$user->id]) }}">フォロー解除</a></p>
            @else
                <p class="btn btn-primary"><a href="{{ route('follow', ['id'=>$user->id]) }}">フォローする</a></p>
            @endif
        </span>
    </div>
    @endif
@endforeach


@endsection
