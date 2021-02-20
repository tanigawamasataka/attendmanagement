@extends('layout')

@section('content')
  <div class="text">・利用者名を選択してください</div>
  <div class="container">
  　<div class="col col-md-offset-3 col-md-5">
      <nav class="panel panel-default">
        <div class="panel-heading">{{ $current_school->school_name }}</div>
          <div class="panel-body">
            <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>氏名</th>
                    <th></th>
                　</tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td><a href="{{ route('punchList', ['user_id' => $user->id]) }}">選択</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table> 
          </div>
          <div class="panel-body">
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection('content')