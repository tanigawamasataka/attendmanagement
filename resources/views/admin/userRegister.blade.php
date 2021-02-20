@extends('/admin/layoutAdmin')

@section('content')
  <div class="container">
  　<div class="col col-md-offset-3 col-md-5">
      <nav class="panel panel-default">
        <div class="panel-heading">新規利用者登録</div>
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
            <form action="{{ route('userRegister') }}" method="post">
            @csrf
              <div class="form-group">
                <label for="admin-name" class="label_for">氏名</label>
                <input type="text" class="form-control w-60" id="admin-name" name="name" />
              </div>
              <div class="form-group label_for" >
                <label for="honko">本校</label>
                <input type="radio" id="honko" name="radio" value="1" checked />
                <label for="honmachiniko">本町2校</label>
                <input type="radio" id="honmachiniko" name="radio" value="2" />
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