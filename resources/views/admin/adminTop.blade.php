<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>出欠管理システム</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header>
      <nav class="my-navbar-admin">
        <span class="my-navbar-title">出欠管理システム</span>
        <div class="my-navbar-control">
            <a class="my-navbar-item" href="#" id=logout>ログアウト</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
        </div>
    </nav>
    </header>
    <main>
        <div class="text">・管理者名: {{ Auth::user()->name }}</div>
        <div class="text">・管理ページを選択してください</div>
        <div class="container">
          <div class="col col-md-offset-3 col-md-5">
            <nav class="panel panel-default">
            <div class="panel-heading">管理ページ</div>
                <div class="panel-body">
                <a href="{{ route('userManagementList') }}" class="btn btn-primary w-50">
                    利用者管理
                </a>
                </div>
                <div class="panel-body">
                <a href="{{ route('performanceManagement') }}" class="btn btn-primary w-50">
                    実績管理
                </a>
                </div>
            </nav>
            </div>
        </div>
        </div>
    </main>
    <script>
        document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
        });
    </script>
</body>
</html>