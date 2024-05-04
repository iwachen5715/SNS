<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="ページの内容を表す文章">
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png">
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png">
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png">
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png">
    <link rel="apple-touch-icon-precomposed" href="画像のURL">
</head>
<body>
<header>
    <div id="head">
       <h1><a href="/top"><img class="topIcon" src="{{ asset('images/atlas.png') }}" alt="タイトル"></a></h1>
        <div id="middle">
            <p class="users menu-btn">{{ Auth::user()->username }} さん <span class="accordion-title"></span>
            <div id="item">
                <img class="Item" src="{{ asset('storage/user-images/'. Auth::user()->images) }}" alt="ユーザーアイコン">
            </div>
        </div>
        <ul class="menu">
            <li class="accordion-code"><a class="home" href="/top">HOME</a></li>
            <li class="accordion-code"><a class="icon" href="/profile">プロフィール編集</a></li>
            <li class="accordion-code"><a class="center" href="/logout">ログアウト</a></li>
        </ul>
    </div>
</header>
<div id="row">
    <div id="container">
        @yield('content')
    </div>
    <div id="side-bar">
        <div id="confirm">
            <div class="side-top">
                <p class="side-username">{{ Auth::user()->username }}さんの</p>
            </div>
            <div class="side-flex">
                <p class="side-username">フォロー数 </p>
                <p>{{ Auth::user()->followings->count() }}人</p>
            </div>
            <div class="side-right">
                <p class="btn btn_base new-btn-class"><a href="{{ asset('/follow-List') }}">フォローリスト</a></p>
            </div>
            <div class="side-flex">
                <p class="side-username">フォロワー数</p>
                <p>{{ Auth::user()->followers()->count() }}人</p>
            </div>
            <div class="side-right">
                <p class="btn btn_base new-btn-class"><a href="{{ asset('/follower-List') }}">フォロワーリスト</a></p>
            </div>
        </div>
        <div class="side-search_btn">
            <p class="btn btn_base search-btn-class"><a href="{{ asset('/search') }}">ユーザー検索</a></p>
        </div>
    </div>
</div>
<footer>
    <!-- ここにフッターのコンテンツを記述 -->
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>
