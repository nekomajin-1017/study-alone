<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    <header class=header>
        <div class="header__inner">
            <a class="header__title" href="/">Todo</a>
        </div>
        <nav class="header__nav">
            <ul class="header__nav-items">
                <li class="header__nav-item"><a class="header__nav-link" href="/">ホーム</a></li>
                <li class="header__nav-item"><a class="header__nav-link" href="/categories">カテゴリー一覧</a></li>
            </ul>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>