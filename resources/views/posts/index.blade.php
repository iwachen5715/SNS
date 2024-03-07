@extends('layouts.login')

@section('content')


<!-- バリデーションメッセージ -->
@if ($errors->any())
<div class="register_error">
   <ul>
      @foreach ($errors->all() as $error)
      <li class="error-message">{{ $error }}</li>
      @endforeach
   </ul>
</div>
@endif


{!! Form::open(['url' => 'post/create']) !!}
<!-- HTMLではフォームタグは長くなるがフォームファサードで短く書き換えられている -->
    <div class= "comment-box">
        <img class="PostIcon" src="{{ asset('storage/user-images/'.
            $user->images) }}" alt="{{ $user->username }}のアイコン">

             <label for="comment"></label>
           <textarea name="post" style ="border:none;width: 70%; height: 100px; font-size: 20px;" cols="100" rows="4" placeholder="投稿内容を入力してください。"></textarea>
        <button type="submit" class="send-btn"><img class="Upload" src="images/post.png"></button>

        <!-- <input type="images" src="{{ asset('images/post.png') }}" class="submit_btn" alt="送信する"> -->
    </div>

 {!! Form::close() !!}

 <!-- グレーの太線 -->
<div class="separator-line"></div>

 <table>
        <thead>
            <tr>
            </tr>
        </thead>
   <tbody>
@foreach ($lists as $list)
   <div class="post-row">
    <!-- ユーザーのアイコンを表示 -->
    <div class="post-cell">
        <img class="MyIcon" src="{{ asset('storage/user-images/'. $list->user->images) }}" alt="{{ $list->user->username }}のアイコン">
    </div>
    <div class="post-group">
        <div class="post-cell">{{ $list->user->username }}</div>
        <div class="post-cell">{{ $list->post }}</div>
    </div>
     <!-- created_atを別のグループにする -->
    <div class="post-cell">{{ $list->created_at }}</div>
</div>

<div class="post-separator"></div>

        <!-- 更新 -->
        @if(Auth::id() == $list->user_id)
            <div class="post-cell">
          <div class="update-btn">
        <a href="" post="{{ $list->post }}" post_id="{{ $list->id }}">
            <img class="Update" src="./images/edit.png" alt="編集" />
        </a>
    </div>
</div>
        @else
            <td class="post-cell"></td>
        @endif
        <!-- 削除 -->
        @if(Auth::id() == $list->user_id)
        <div class="post-cell">
        <div class="delete-btn">
        <a href="/post/{{ $list->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
            <img class="Trash" src="./images/trash.png" alt="削除" />
        </a>
    </div>
</div>
        @else
            <td class="post-cell"></td>
        @endif
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
