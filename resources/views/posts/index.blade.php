@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'post/create']) !!}
<!-- HTMLではフォームタグは長くなるがフォームファサードで短く書き換えられている -->
    <div class= "comment-box">
        <img class="PostIcon" src="{{ asset('storage/user-images/'. $user->images) }}" alt="{{ $user->username }}のアイコン">
        <div class="postContents">
             {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) !!}
        </div>
        <!-- <button type="submit" class="btn btn-success pull-right"><img class="Upload" src="images/post.png"></button> -->
        <button type="submit" class="send-btn"><img class="Upload" src="images/post.png"></button>

        <!-- <input type="images" src="{{ asset('images/post.png') }}" class="submit_btn" alt="送信する"> -->
    </div>

 {!! Form::close() !!}
 <table>
        <thead>
            <tr>
            </tr>
        </thead>
   <tbody>
@foreach ($lists as $list)
    <tr>
        <div class="post-row">
            <!-- ユーザーのアイコンを表示 -->
            <td>
                <img class="MyIcon" src="{{ asset('storage/user-images/'. $list->user->images) }}" alt="{{ $list->user->username }}のアイコン">
            </td>
            <td>{{ $list->user->username }}</td>
            <td>{{ $list->post }}</td>
            <td>{{ $list->created_at }}</td>

            <!-- 更新 -->
            @if(Auth::id() == $list->user_id)
                <td><a class="js-modal-open" href="" post="{{ $list->post }}" post_id="{{ $list->id }}"><img class="Update" src="./images/edit.png" alt="編集" /></a></td>
            @else
                <td></td>
            @endif
            <!-- 削除 -->
            @if(Auth::id() == $list->user_id)
                <td><a class="btn btn-danger" href="/post/{{$list->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"><img class="Trash" src="./images/trash.png" alt="削除" /></a></td>
            @else
                <td></td>
            @endif

        </div>
    </tr>
@endforeach
</tbody>
</table>

<!-- モーダルの中身 -->
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <form action="{{ route('update.post') }}" method="post"> <!-- 適切なルート名を指定 -->
            <textarea name="Post" class="modal_post"></textarea>
            <input type="hidden" name="id" class="modal_id" value="">
            <input type="submit" value="更新">
            @csrf <!-- Laravel の CSRF トークンを追加 -->
        </form>
        <a class="js-modal-close" href="">閉じる</a>
    </div>
</div>
@endsection
