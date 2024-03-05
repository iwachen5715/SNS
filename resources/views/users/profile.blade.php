@extends('layouts.login')

@section('content')

<!-- プロフィール編集画面 -->

<img src="{{ asset('storage/user-images/'. Auth::user()->images) }}" class="icon-image">


<!-- プロフィールへのリンク -->
<!-- <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}">マイプロフィール</a> -->

<a href="{{ route('profile.show', ['id' => $user->id]) }}"></a>


<!-- 適切なURLを入力してください -->
<!-- {!! Form::open(['url' => '/profile.edit', 'enctype' => 'multipart/form-data']) !!}
{!! Form::open(['url' => '/profile.update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} -->
{!! Form::open(['route' => 'profile.update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<!-- enctype 属性: フォームデータがファイルを含む場合、enctype 属性を multipart/form-data に設定する必要があります。これにより、ファイルアップロードなどのバイナリデータをサーバーに送信できる -->


<div class="form-group">
   <p>user name</p>
   <input type="text" class="items-input" name="username" value="{{ auth()->user()->username}}">
</div>

<div class="form-group">
   <p>mail adress</p>
   <input type="email" class="items-input" name="mail" value="{{ auth()->user()->mail }}">
</div>

<div class="form-group">
    <p>password</p>
    <input type="password" class="items-input" name="password">
</div>

<div class="form-group">
    <p>password confirm</p>
    <input type="password" class="items-input" name="password_confirmation">
</div>

<div class="form-group">
    <p>bio</p>
    <input type="text" class="items-input"  name="bio" value="{{ auth()->user()->bio }}">
</div>

<div class="form-group">
    <p>icon image</p>
        <div id="app">
          <label class="file-label">
            <input type="file" name="icon_image">ファイルを選択
          </label>
        </div>
      </div>


    <!-- {{ Form::input('hidden', 'id', Auth::user()->id) }} -->

   <div class="btn-update">
    <p class="btn btn-update_color">更新</p>
  </div>


<!--バリデーションエラーメッセージ-->
@if($errors->any())
<div class="edit_error">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif


@endsection
