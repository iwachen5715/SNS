@extends('layouts.logout')

@section('content')





@section('content')
<!-- フォームファザード  適切なURLを入力してください -->
<div class="login-form">
   {!! Form::open(['url' => '/register']) !!}

   <p class="hello">新規ユーザー登録</p>

   <!-- バリデーションメッセージ -->
   @if ($errors->any())
   <div class="register_error">
      <ul>
         @foreach ($errors->all() as $error)
         <li class="error-font">{{ $error }}</li>
         @endforeach
      </ul>
   </div>
   @endif

   <div class="box">

      <!-- ユーザー名 -->
      <div class="set">
         {{ Form::label('username','ユーザー名',['class' => 'login']) }}
         <br>
         {{ Form::text('username',null,['class' => 'input']) }}
         <br>
      </div>

      <!-- メールアドレス -->
      <div class="set">
         {{ Form::label('e-mail','メールアドレス',['class' => 'login'])  }}
         <br>
         {{ Form::text('mail',null,['class' => 'input']) }}
         <br>
      </div>

      <!-- パスワード -->
      <div class="set">
         {{ Form::label('password','パスワード',['class' => 'login'])  }}
         <br>
         {{ Form::password('password',['class' => 'password']) }}
         <br>
      </div>

      <!-- パスワード確認-->
      <div class="set">
         {{ Form::label('password','パスワード確認',['class' => 'login'])  }}
         <br>

         {{ Form::password('password_confirmation',['class' => 'password']) }}

         <br>
      </div>

      <!-- 登録(REGISTER)ボタン -->
      {{ Form::submit('新規登録',['class' => 'login-btn']) }}

      <p class="register"><a href="/login">ログイン画面に戻る</a></p>
   </div>
   {!! Form::close() !!}

</div>


@endsection
