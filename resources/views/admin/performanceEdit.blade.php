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
        <div class="panel-heading">実績編集・削除</div>
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
            <form action="{{ route('performanceEdit', ['performance_id' => $performance->id]) }}" method="post">
            @csrf
              <table>
                <tr>
                  <td class="form-title">氏名</td>
                  <td>{{ $performance->timecard->user->name }}</td>
                  <input type="hidden" name="name" value="{{ $performance->timecard->user->name }}"/>
                </tr>
                <tr>
                  <td class="form-title">日付</td>
                  <td class="form-contents"><input type="text" name="attend_date" class="form-performance" id="attend_date" value={{ $performance->timecard->attend_date }}/></td>
                </tr>
                <tr>
                  <td class="form-title">開始時間</td>
                  <td>
                    <select class="form-performance" name="punch_in">
                        <option value="9:30" @if($performance->timecard->punch_in == '9:30:00') selected @endif>9:30</option>
                        <option value="9:45" @if($performance->timecard->punch_in == '9:45:00') selected @endif>9:45</option>
                        <option value="10:00" @if($performance->timecard->punch_in == '10:00:00') selected @endif>10:00</option>
                        <option value="10:15" @if($performance->timecard->punch_in == '10:15:00') selected @endif>10:15</option>
                        <option value="10:30" @if($performance->timecard->punch_in == '10:30:00') selected @endif>10:30</option>
                        <option value="10:45" @if($performance->timecard->punch_in == '10:45:00') selected @endif>10:45</option>
                        <option value="11:00" @if($performance->timecard->punch_in == '11:00:00') selected @endif>11:00</option>
                        <option value="11:15" @if($performance->timecard->punch_in == '11:15:00') selected @endif>11:15</option>
                        <option value="11:30" @if($performance->timecard->punch_in == '11:30:00') selected @endif>11:30</option>
                        <option value="11:45" @if($performance->timecard->punch_in == '11:45:00') selected @endif>11:45</option>
                        <option value="12:00" @if($performance->timecard->punch_in == '12:00:00') selected @endif>12:00</option>
                        <option value="12:15" @if($performance->timecard->punch_in == '12:15:00') selected @endif>12:15</option>
                        <option value="12:30" @if($performance->timecard->punch_in == '12:30:00') selected @endif>12:30</option>
                        <option value="12:45" @if($performance->timecard->punch_in == '12:45:00') selected @endif>12:45</option>
                        <option value="13:00" @if($performance->timecard->punch_in == '13:00:00') selected @endif>13:00</option>
                        <option value="13:15" @if($performance->timecard->punch_in == '13:15:00') selected @endif>13:15</option>
                        <option value="13:30" @if($performance->timecard->punch_in == '13:30:00') selected @endif>13:30</option>
                        <option value="13:45" @if($performance->timecard->punch_in == '13:45:00') selected @endif>13:45</option>
                        <option value="14:00" @if($performance->timecard->punch_in == '14:00:00') selected @endif>14:00</option>
                        <option value="14:15" @if($performance->timecard->punch_in == '14:15:00') selected @endif>14:15</option>
                        <option value="14:30" @if($performance->timecard->punch_in == '14:30:00') selected @endif>14:30</option>
                        <option value="14:45" @if($performance->timecard->punch_in == '14:45:00') selected @endif>14:45</option>
                        <option value="15:00" @if($performance->timecard->punch_in == '15:00:00') selected @endif>15:00</option>
                        <option value="15:15" @if($performance->timecard->punch_in == '15:15:00') selected @endif>15:15</option>
                        <option value="15:30" @if($performance->timecard->punch_in == '15:30:00') selected @endif>15:30</option>
                        <option value="15:45" @if($performance->timecard->punch_in == '15:45:00') selected @endif>15:45</option>
                    </select>
                  </td>
                </tr>
                <tr>
                    <td class="form-title">終了時間</td>
                    <td>
                      <select class="form-performance" name="punch_out">
                        <option value="9:45" @if($performance->timecard->punch_out == '9:45:00') selected @endif>9:45</option>
                        <option value="10:00" @if($performance->timecard->punch_out == '10:00:00') selected @endif>10:00</option>
                        <option value="10:15" @if($performance->timecard->punch_out == '10:15:00') selected @endif>10:15</option>
                        <option value="10:30" @if($performance->timecard->punch_out == '10:30:00') selected @endif>10:30</option>
                        <option value="10:45" @if($performance->timecard->punch_out == '10:45:00') selected @endif>10:45</option>
                        <option value="11:00" @if($performance->timecard->punch_out == '11:00:00') selected @endif>11:00</option>
                        <option value="11:15" @if($performance->timecard->punch_out == '11:15:00') selected @endif>11:15</option>
                        <option value="11:30" @if($performance->timecard->punch_out == '11:30:00') selected @endif>11:30</option>
                        <option value="11:45" @if($performance->timecard->punch_out == '11:45:00') selected @endif>11:45</option>
                        <option value="12:00" @if($performance->timecard->punch_out == '12:00:00') selected @endif>12:00</option>
                        <option value="12:15" @if($performance->timecard->punch_out == '12:15:00') selected @endif>12:15</option>
                        <option value="12:30" @if($performance->timecard->punch_out == '12:30:00') selected @endif>12:30</option>
                        <option value="12:45" @if($performance->timecard->punch_out == '12:45:00') selected @endif>12:45</option>
                        <option value="13:00" @if($performance->timecard->punch_out == '13:00:00') selected @endif>13:00</option>
                        <option value="13:15" @if($performance->timecard->punch_out == '13:15:00') selected @endif>13:15</option>
                        <option value="13:30" @if($performance->timecard->punch_out == '13:30:00') selected @endif>13:30</option>
                        <option value="13:45" @if($performance->timecard->punch_out == '13:45:00') selected @endif>13:45</option>
                        <option value="14:00" @if($performance->timecard->punch_out == '14:00:00') selected @endif>14:00</option>
                        <option value="14:15" @if($performance->timecard->punch_out == '14:15:00') selected @endif>14:15</option>
                        <option value="14:30" @if($performance->timecard->punch_out == '14:30:00') selected @endif>14:30</option>
                        <option value="14:45" @if($performance->timecard->punch_out == '14:45:00') selected @endif>14:45</option>
                        <option value="15:00" @if($performance->timecard->punch_out == '15:00:00') selected @endif>15:00</option>
                        <option value="15:15" @if($performance->timecard->punch_out == '15:15:00') selected @endif>15:15</option>
                        <option value="15:30" @if($performance->timecard->punch_out == '15:30:00') selected @endif>15:30</option>
                        <option value="15:45" @if($performance->timecard->punch_out == '15:45:00') selected @endif>15:45</option>
                        <option value="16:00" @if($performance->timecard->punch_out == '16:00:00') selected @endif>16:00</option>   
                      </select>
                    </td>
                </tr>
                <tr>
                  <td class="form-title">食事提供加算</td>
                  <input type="hidden" name="meal_fg" value="0" />
                  <td><input type="checkbox" name="meal_fg" value="1" @if($performance->meal_fg == '1') checked @endif></td>
                </tr>
                <tr>
                  <td class="form-title">施設外支援加算</td>
                  <input type="hidden" name="outside_fg" value="0" />
                  <td><input type="checkbox" name="outside_fg" value="2"@if($performance->outside_fg == '2') checked @endif></td>
                </tr>
                <tr>
                  <td class="form-title">医療連携加算</td>
                  <input type="hidden" name="medical_fg" value="0" />
                  <td><input type="checkbox" name="medical_fg" value="2" @if($performance->medical_fg == '2') checked @endif></td>
                </tr>
                <tr>
                  <td class="form-title">備考</td>
                  <td>
                    <select name="note">
                      <option value="1" @if($performance->note == '1') selected @endif>通所</option>
                      <option value="2" @if($performance->note == '2') selected @endif>スカイプ</option>
                      <option value="3" @if($performance->note == '3') selected @endif>メール</option>
                      <option value="4" @if($performance->note == '4') selected @endif>訪問</option>
                    </select>
                  </td>
                </tr>
              </table>
                <button type="submit" class="btn btn-primary" name="update" value="update">更新</button>
                <button type="submit" class="btn btn-danger delete-button" name="delete" value="delete">削除</button>
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