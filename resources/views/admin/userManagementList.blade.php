@extends('/admin/layoutAdmin')

@section('content')
  <div class="text">・利用者の所属校を選択してください</div>
  <div class="container">
        <div class="form-group col-md-offset-3 col-md-2">
            {!! Form::open(['route' => 'userManagementList', 'method' => 'post']) !!}
              {!! Form::select('school', Config::get('schools.value'), null, ['class' => 'form-control col-sm-3']) !!}
        </div>
        <div class="form-group col-offset-4 col-md-3">
              {!! Form::submit('検索', ['class' => 'btn btn-info']) !!}
            {!! Form::close() !!}
        </div>
        <div class="form-group col-offset-5 col-md-4">
          <a href="{{ route('userRegister') }}" class="btn btn-primary">新規利用者登録</a>
        </div>
  </div>
  <div class="container">
  　<div class="col col-md-offset-3 col-md-5">
      <nav class="panel panel-default">
        <div class="panel-heading">@if(!empty($current_school)){{ $current_school->school_name }}@endif</div>
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
                    <td><a href="{{ route('userEdit', ['user_id' => $user->id] ) }}">編集</td>
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