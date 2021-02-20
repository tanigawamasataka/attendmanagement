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
    　<nav class="my-navbar">
        <span class="my-navbar-title">出欠管理システム</span>
        <div class="my-navbar-control">
        <a class="my-navbar-item" href="{{ route('admin.login') }}">管理者ページへ</a>
        </div>
    </nav>
    </header>
    <main>
      <div class="text">・所属校を選択してください</div>
      <div class="container">
      　<div class="col col-md-offset-3 col-md-5">
          <nav class="panel panel-default">
            <div class="panel-heading">所属校</div>
              @foreach($schools as $school) 
              <div class="panel-body">
                <a href="{{ route('userNameList', ['id' => $school->id]) }}" class="btn btn-primary w-50">
                  {{ $school->school_name }}
                </a>
              </div>
              @endforeach
            </nav>
          </div>
        </div>
      </div>
    </main>
</body>
</html>