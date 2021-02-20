@extends('/admin/layoutAdmin')

@section('content')
  <div class="container">
  　<div class="col col-md-offset-3 col-md-5">
      <nav class="panel panel-default">
        <div class="panel-heading">利用者情報編集</div>
          <div class="panel-body">
            @if($errors->any())
            <div class="text-danger mt-3">
              <ul>
              @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
              @endforeach
              </ul>
            </div>
            @endif
            <form action="{{ route('userEdit', ['user_id' => $user->id]) }}" method="post">
              @csrf
              <div class="form-group label_for">
                <label for="admin-name">氏名</label>
                <input type="text" class="form-control w-70" id="admin-name" name="name" value="{{ old('name') ?? $user->name }}"/>
              </div>
              <div class="form-group label_for">
                <label for="honko">本校</label>
                <input type="radio" id="honko" name="radio" value="1" @if($user->school_id == 1) checked @endif />
                <label for="honmachiniko">本町2校</label>
                <input type="radio" id="honmachiniko" name="radio" value="2" @if($user->school_id == 2) checked @endif />
              </div>
              <div class="form-group label_for">
                <button type="submit" class="btn btn-primary" name="update" value="update">更新</button>
                <button type="submit" class="btn btn-danger delete-button" name="delete" value="delete">削除</button>
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