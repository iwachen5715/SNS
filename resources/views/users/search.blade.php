@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'post/create']) !!}
     <div class="form-group">
         {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザー名']) !!}
     </div>
     <button type="submit" class="btn btn-success pull-right"><img src="images/post.png"></button>
 {!! Form::close() !!}
@endsection
