@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
{!! Form::open(['url' => 'post/create']) !!}
<!-- HTMLではフォームタグは長くなるがフォームファサードで短く書き換えられている -->
     <div class="form-group">
         {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) !!}
     </div>
     <button type="submit" class="btn btn-success pull-right"><img class="Upload" src="images/post.png"></button>
 {!! Form::close() !!}
@foreach ($lists as $list)
    <tr>
        <td>{{ $list->user->username }}</td>
        <td>{{ $list->user_id }}</td>
        <td>{{ $list->post }}</td>
        <td>{{ $list->created_at }}</td>
        <!-- 更新 -->
        <td><a class="js-modal-open" href="" post="{{ $list->post }}" post_id="{{ $list->id }}"><img class="Update" src="./images/edit.png" alt="編集" /></a></td>
        <!-- 削除 -->
        <td><a class="btn btn-danger" href="/post/{{$list->id}}/delete"onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"><img class="Trash" src="./images/trash.png" alt="削除" /></a></td>
         <!-- aタグによって別のページに移動する属性でhref属性でその方向性を記述している -->
    </tr>
@endforeach
 <!-- モーダルの中身 -->
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
           <form action="post/update" method="post">
                <textarea name="Post" class="modal_post"></textarea><!-- 名前をつける-->
                <input type="hidden" name="id" class="modal_id" value="">
                <input type="submit" value="更新">
                {{ csrf_field() }}
           </form>
           <a class="js-modal-close" href="">閉じる</a>
        </div>
    </div>
@endsection
