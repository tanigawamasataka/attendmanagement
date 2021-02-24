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
                    @foreach($punch_ins as $punch_in)                                                                 
                      <option value="{{$punch_in}}" @if($performance->timecard->punch_in == $punch_in) selected @endif>{{mb_substr($punch_in, 0,5 )}}</option>
                    @endforeach    
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="form-title">終了時間</td>
                  <td>
                    <select class="form-performance" name="punch_out">
                    @foreach($punch_outs as $punch_out)
                      <option value="{{$punch_out}}" @if($performance->timecard->punch_out == $punch_out) selected @endif>{{mb_substr($punch_out, 0,5 )}}</option>
                    @endforeach    
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
      maxDate: new Date(),
    });
  </script>
@endsection