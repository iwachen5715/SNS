<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewprt" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
            <h1><a href="/top"><img class="topIcon" src="images/atlas.png"></a></h1>
            <div id = "middle">
                <p class="users menu-btn">{{ Auth::user()->username }} さん <span class="accordion-title"></span>
                <div id = "item">
                    <img class="Item" src="{{ asset('storage/user-images/'. Auth::user()->images) }}">
                </div>
            </div>
             <!--アコーディオンメニュ-->
            <ul class="menu">

            <li><a class="home" href="/top">HOME</a></li>
            <li>
                 <a class="icon" href="/profile">プロフィール編集</a>
                </li>
            <li><a class="center" href="/logout">ログアウト</a></li>
            </ul>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <!-- 右側 -->
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
        <p class="btn btn_base"><a href="{{ asset('/follow-List') }}">フォローリスト</a></p>
</div>

<div class="side-flex">
    <p class="side-username">フォロワー数</p>
    <p>{{ Auth::user()->followers()->count() }}人</p>
</div>
<div class="side-right">
    <p class="btn btn_base"><a href="{{ asset('/follower-List') }}">フォロワーリスト</a></p>
  </div>
</div>

<div class="side-search_btn">
    <p class="btn btn_bases"><a href="{{ asset('/search') }}">ユーザー検索</a></p>
</div>

</div>
</div>
<footer>
</footer>
</footer>
    <!--JSリンクの設置 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>
