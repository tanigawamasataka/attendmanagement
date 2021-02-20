<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>出欠管理システム</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header>
    　<nav class="my-navbar">
        <span class="my-navbar-title">出欠管理システム</span>
        <div class="my-navbar-control">
        <a class="my-navbar-item" href="{{ route('admin.top') }}">管理者トップへ戻る</a>
        </div>
      </nav>
    </header>
    <main>
    @yield('content')
    </main>
    @yield('scripts')
</body>
</html>