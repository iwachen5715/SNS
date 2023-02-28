@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
{!! Form::open(['url' => 'post/create']) !!}
<!-- HTMLではフォームタグは長くなるがフォームファサードで短く書き換えられている -->
     <div class="form-group">
         {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) !!}
     </div>
     <button type="submit" class="btn btn-success pull-right"><img src="images/post.png"></button>
 {!! Form::close() !!}
@foreach ($lists as $list)
    <tr>
        <td>{{ $list->user_id }}</td>
        <td>{{ $list->post }}</td>
        <td>{{ $list->created_at }}</td>
    </tr>
@endforeach
@endsection
