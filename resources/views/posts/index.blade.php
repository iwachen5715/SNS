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
        <div class="comment-box">
            <img class="PostIcon" src="{{ asset('storage/user-images/'.$user->images) }}" alt="{{ $user->username }}のアイコン">
            <textarea name="post" style="border:none;width: 70%; height: 100px; font-size: 20px;" placeholder="投稿内容を入力してください。"></textarea>
            <button type="submit" class="send-btn"><img class="Upload" src="images/post.png"></button>
        </div>
    {!! Form::close() !!}
    <!-- グレーの太線 -->
    <div class="separator-line"></div>
    <table>
        <thead>
            <tr></tr>
        </thead>
        <tbody>
            @foreach ($lists->reverse() as $list)
                <div class="post-row">
                    <!-- ユーザーのアイコンを表示 -->
                    <div class="post-cell">
                        <img class="MyIcon" src="{{ asset('storage/user-images/'. $list->user->images) }}" alt="{{ $list->user->username }}のアイコン">
                    </div>
                    <div class="post-group">
                        <div class="post-cell">{{ $list->user->username }}</div>
                        <div class="post-cell">{!! nl2br(e($list->post)) !!}</div>
                    </div>
                    <!-- created_atを別のグループにする -->
                    <div class="post-cell">{{ $list->created_at->format('Y-m-d H:i') }}</div>
                </div>
                <!-- 更新 -->
                @if(Auth::id() == $list->user_id)
                    <div class="post-cell">
                        <div class="update-btn">
                            <a href="#" class="js-modal-open" post="{{ $list->post }}" post_id="{{ $list->id }}" >
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
                        <div>
                             <a  class="Trash" href="/post/{{ $list->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
                             </a>
                        </div>
                    </div>
                @else
                    <td class="post-cell"></td>
                @endif
                <div class="post-separator"></div>
            @endforeach
        </tbody>
    </table>

   <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <form id="updateForm" action="{{ route('update.post') }}" method="post">
            <textarea id="postTextarea" name="Post" class="modal_post"></textarea>
            <input type="hidden" name="id" class="modal_id" value="">
            @csrf <!-- Laravel の CSRF トークンを追加 -->
        </form>
        <!-- 更新ボタン -->
        <img class="edit-mark" src="{{ asset('images/edit.png') }}" alt="更新" onclick="document.getElementById('updateForm').submit()">
        <a class="js-modal-close" href=""></a>
    </div>
</div>

@endsection
