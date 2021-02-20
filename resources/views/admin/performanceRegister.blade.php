@extends('/admin/layoutAdmin')

@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
  <div class="text"></div>
  <div class="container">
  　<div class="col col-md-offset-3 col-md-5">
      <nav class="panel panel-default">
        <div class="panel-heading">新規実績登録</div>
          <div class="panel-body">
            @if($errors->any())
            <div class="text-danger mt-3">
              <ul>
              @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
              @endforeach
              </ul>
            </div>
            @elseif (session('error'))
              <p class="text-danger mt-3">
                {{ session('error') }}
              </p>
            @endif
            <form action="{{ route('performanceRegister', ['user_id' => $user->id])}}" method="post">
            @csrf
              <table>
              <input type="hidden" name="user_id" value={{ $user->id }} />
              <input type="hidden" name="status" value="3" />
                <tr>
                  <td class="form-title">氏名</td>
                  <td>{{$user->name}}</td>
                </tr>
                <tr>
                  <td class="form-title">日付</td>
                  <td><input type="text" class="form-performance" id="attend_date" name="attend_date" value={{ \Carbon\Carbon::today() }}/></td>
                </tr>
                <tr>
                  <td class="form-title">開始時間</td>
                  <td><select class="form-performance" name="punch_in" >
                          <option value="9:30">9:30</option>
                          <option value="9:45">9:45</option>
                          <option value="10:00">10:00</option>
                          <option value="10:15">10:15</option>
                          <option value="10:30">10:30</option>
                          <option value="10:45">10:45</option>
                          <option value="11:00">11:00</option>
                          <option value="11:15">11:15</option>
                          <option value="11:30">11:30</option>
                          <option value="11:45">11:45</option>
                          <option value="12:00">12:00</option>
                          <option value="12:15">12:15</option>
                          <option value="12:30">12:30</option>
                          <option value="12:45">12:45</option>
                          <option value="13:00">13:00</option>
                          <option value="13:15">13:15</option>
                          <option value="13:30">13:30</option>
                          <option value="13:45">13:45</option>
                          <option value="14:00">14:00</option>
                          <option value="14:15">14:15</option>
                          <option value="14:30">14:30</option>
                          <option value="14:45">14:45</option>
                          <option value="15:00">15:00</option>
                          <option value="15:15">15:15</option>
                          <option value="15:30">15:30</option>
                          <option value="15:45">15:45</option>
                      </select></td>
                </tr>
                <tr>
                  <td class="form-title">終了時間</td>
                  <td><select class="form-performance" name="punch_out">
                          <option value="9:45">9:45</option>
                          <option value="10:00">10:00</option>
                          <option value="10:15">10:15</option>
                          <option value="10:30">10:30</option>
                          <option value="10:45">10:45</option>
                          <option value="11:00">11:00</option>
                          <option value="11:15">11:15</option>
                          <option value="11:30">11:30</option>
                          <option value="11:45">11:45</option>
                          <option value="12:00">12:00</option>
                          <option value="12:15">12:15</option>
                          <option value="12:30">12:30</option>
                          <option value="12:45">12:45</option>
                          <option value="13:00">13:00</option>
                          <option value="13:15">13:15</option>
                          <option value="13:30">13:30</option>
                          <option value="13:45">13:45</option>
                          <option value="14:00">14:00</option>
                          <option value="14:15">14:15</option>
                          <option value="14:30">14:30</option>
                          <option value="14:45">14:45</option>
                          <option value="15:00">15:00</option>
                          <option value="15:15">15:15</option>
                          <option value="15:30">15:30</option>
                          <option value="15:45">15:45</option>
                          <option value="16:00">16:00</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td class="form-title">食事提供加算</td>
                  <input type="hidden" name="meal_fg" value="0" />
                  <td><input type="checkbox" name="meal_fg" value="1"></td>
                </tr>
                <tr>
                  <td class="form-title">施設外支援加算</td>
                  <input type="hidden" name="outside_fg" value="0" />
                  <td><input type="checkbox" name="outside_fg" value="2"></td>
                </tr>
                <tr>
                  <td class="form-title">医療連携加算</td>
                  <input type="hidden" name="medical_fg" value="0" />
                  <td><input type="checkbox" name="medical_fg" value="2"></td>
                </tr>
                <tr>
                  <td class="form-title">備考</td>
                  <td>
                    <select name="note">
                      <option value="1">通所</option>
                      <option value="2">スカイプ</option>
                      <option value="3">メール</option>
                      <option value="4">訪問</option>
                    </select>
                  </td>
                </tr>
              </table>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
          </div>
          <div class="panel-body">
            
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection('content')

@section('scripts')
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script>
    flatpickr(document.getElementById('attend_date'), {
      locale: 'ja',
      dateFormat: "Y/m/d",
      
    });
  </script>
@endsection