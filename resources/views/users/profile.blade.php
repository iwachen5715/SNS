@extends('layouts.login')

@section('content')

<!-- バリデーションエラーメッセージ -->
@if($errors->any())
<div class="edit_error">
  <ul>
    @foreach($errors->all() as $error)
    <li class="error-message-profile">{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

<!-- プロフィール編集画面 -->
<!-- divタグ -->
<div class="flex-items">
<div class="flex-container">
    <img src="{{ asset('storage/user-images/'. Auth::user()->images) }}" class="icon-image">
    {!! Form::open(['route' => 'profile.update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
</div>

<div style="width:100%;margin-top :40px;">
<div class="form-group">
   <p>ユーザー名</p>
   <input type="text" class="items-input" name="username" value="{{ auth()->user()->username}}">
</div>

<div class="form-group">
   <p>メールアドレス</p>
   <input type="email" class="items-input" name="mail" value="{{ auth()->user()->mail }}">
</div>

<div class="form-group">
    <p>パスワード</p>
    <input type="password" class="items-input" name="password">
</div>

<div class="form-group">
    <p>パスワード確認</p>
    <input type="password" class="items-input" name="password_confirmation">
</div>

<div class="form-group">
    <p>自己紹介</p>
    <input type="text" class="items-input"  name="bio" value="{{ auth()->user()->bio }}">
</div>

<div class="form-group">
    <p>アイコン画像</p>
        <div id="app">
          <label class="file-label">
            <input type="file" name="images">ファイルを選択
          </label>
        </div>
      </div>
  </div>
  </div>


    {{ Form::input('hidden', 'id', Auth::user()->id) }}

<!-- 更新ボタン -->
<div class="btn-update">
 <button type="submit" class="btn btn-update_color">更新</button>
  </div>
</form>



@endsection
