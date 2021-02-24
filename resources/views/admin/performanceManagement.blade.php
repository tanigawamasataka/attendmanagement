@extends('/admin/layoutAdmin')

@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
  <div class="container">
    <div class="form-group col-offset-2 col-md-2">
        {!! Form::open(['route' => 'performanceManagement', 'method' => 'post']) !!}
          {!! Form::select('schools', Config::get('schools.value'), null, ['class' => 'form-control col-sm-3']) !!}
    </div>
    <div class="form-group col-offset-2 col-md-2">
          {!! Form::text('attend_date', '', ['class' => 'form-control', 'id' => 'attend_date', 'placeholder' => '実績の日付を入力']) !!}
    </div>
    <div class="form-group col-offset-2 col-md-3">
          {!! Form::submit('検索', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>
    <a href="{{ route('userListPerformanceRegister') }}" class="btn btn-primary">新規実績登録</a>
    <a href="{{ route('attendanceForDate') }}" class="btn btn-primary">日付別出席者一覧</a>
  </div>
  <div class="container">
  　<div class="col col-md-offset-0col-md-12">
      <nav class="panel panel-default">
        <div class="panel-heading">@if(!empty($current_school)){{ $current_school->school_name }}@endif 実績一覧</div>
          <div class="panel-body">
            <table class="table">
                <thead>
                   <tr>
                        <th>日付</th>
                        <th>氏名</th>
                        <th>開始時間</th>
                        <th>終了時間</th>
                        <th>食事提供加算</th>
                        <th>施設外支援加算</th>
                        <th>医療連携体系加算</th>
                        <th>備考</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>        
                @foreach ($performances as $performance)
                    <tr class="table-td">
                        <td>{{ $performance->timecard->attend_date->isoformat('YYYY/MM/DD') }}</td>
                        <td><a href="{{ route('individualPerformance', ['user_id' => $performance->timecard->user->id, 'timecard_id' => $performance->timecard_id]) }}">{{ optional($performance->timecard->user)->name }}</a></td>
                        <td>{{ mb_substr($performance->timecard->punch_in, 0, 5 )}}</td>
                        <td>{{ mb_substr($performance->timecard->punch_out, 0, 5 )}}</td>
                        <td id="meal_fg">{{ $performance->meal_fg }}</td>
                        <td id="outside_fg">{{ $performance->outside_fg }}</td>
                        <td id="medical_fg">{{ $performance->medical_fg }}</td>
                        <td><span class="label {{ $performance->note_class }}">{{ $performance->note_label }}</span></td>
                        <td><a href="{{ route('performanceEdit', ['performance_id' => $performance->id]) }}">編集</a><td>
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
@endsection

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