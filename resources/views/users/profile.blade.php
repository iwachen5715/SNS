@extends('layouts.login')
@section('content')

<!-- プロフィール編集画面 -->

<img src="{{ asset('storage/user-images/'. Auth::user()->images) }}" class="icon-image">


<!-- プロフィールへのリンク -->
<!-- <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}">マイプロフィール</a> -->

<a href="{{ route('profile.show', ['id' => $user->id]) }}">ユーザーのプロフィール</a>


<!-- 適切なURLを入力してください -->
<!-- {!! Form::open(['url' => '/profile.edit', 'enctype' => 'multipart/form-data']) !!}
{!! Form::open(['url' => '/profile.update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} -->
{!! Form::open(['route' => 'profile.update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<!-- enctype 属性: フォームデータがファイルを含む場合、enctype 属性を multipart/form-data に設定する必要があります。これにより、ファイルアップロードなどのバイナリデータをサーバーに送信できる -->


<div class="form-group">
    {{ Form::label('user name', 'user name') }}
    {{ Form::text('username', Auth::user()->username, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('mail address', 'mail address') }}
    {{ Form::text('mail', Auth::user()->mail, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('password', 'password') }}
    {{ Form::password('password', ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('password confirm', 'password confirm') }}
    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('bio', 'bio') }}
    {{ Form::text('bio', Auth::user()->bio, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('icon image', 'icon image') }}
    {{ Form::file('images', ['class' => 'form-control']) }}
</div>


    {{ Form::input('hidden', 'id', Auth::user()->id) }}

    <div class="form-group">
        {{ Form::submit('更新', ['class' => 'btn btn-success']) }}
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
