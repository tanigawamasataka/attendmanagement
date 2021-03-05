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
            @if (session('error'))
              <p class="text-danger mt-3">
                {{ session('error') }}
              </p>
            @endif
            <form action="{{ route('performanceRegisterByAttendDate', ['timecard_id' => $timecard->id]) }}" method="post">
              @csrf
              <table>
                <tr>
                  <td class="form-title">氏名</td>
                  <td>{{$timecard->user->name}}</td> 
                </tr>
                <tr>
                  <td class="form-title">日付</td>
                  <td>{{$timecard->attend_date->isoformat('YYYY/MM/DD')}}</td>
                </tr>
                <tr>
                  <td class="form-title">開始時間</td>
                  <td>{{ mb_substr($timecard->punch_in, 0, 5 )}}</td>
                </tr>
                <tr>
                  <td class="form-title">終了時間</td>
                  <td>{{ mb_substr($timecard->punch_out, 0, 5 )}}</td>
                </tr>
                <input type="hidden" name="timecard_id" value={{$timecard->id}} />
                <input type="hidden" name="user_id" value={{$timecard->user_id}} />
                <input type="hidden" name="attend_date" value={{$timecard->attend_date->isoformat('YYYY/MM/DD') }} />
                <tr>
                  <td class="form-title">食事提供加算</td>
                  <td><input type="checkbox" name="meal_fg" value="1"></td>
                </tr>
                <tr>
                  <td class="form-title">施設外支援加算</td>
                  <td><input type="checkbox" name="outside_fg" value="2"></td>
                </tr>
                <tr>
                  <td class="form-title">医療連携加算</td>
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
      dateFormat: "Y-m-d",
      
    });
  </script>
@endsection