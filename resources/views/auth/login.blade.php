@extends('layout')

@section('content')
  <div class="text">・管理者ログインしてください</div>
  <div class="container">
  　<div class="col col-md-offset-3 col-md-5">
      <nav class="panel panel-default">
        <div class="panel-heading">ログイン</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="text-danger mt-3">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
            @csrf
              <div class="form-group">
                <label for="name" class="label_for">管理者名</label>
                <input type="text" class="form-control w-60" id="name" name="name" value="{{ old('name') }}" />
              </div>
              <div class="form-group">
                <label for="password" class="label_for">パスワード</label>
                <input type="password" class="form-control w-60" id="password" name="password" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
          <div class="panel-body">
            
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection('content')