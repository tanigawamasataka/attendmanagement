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
                  <td>
                    <select class="form-performance" name="punch_in" >
                    @foreach($punch_ins as $punch_in)
                      <option value="{{$punch_in}}">{{$punch_in}}</option>
                    @endforeach
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="form-title">終了時間</td>
                  <td>
                    <select class="form-performance" name="punch_out">
                    @foreach($punch_outs as $punch_out)
                      <option value="{{$punch_out}}">{{$punch_out}}</option>
                    @endforeach     
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
      maxDate: new Date(),
    });
  </script>
@endsection