@extends('/admin/layoutAdmin')

@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
  <div class="container">
    <div class="form-group col-offset-2 col-md-2">
        {!! Form::open(['route' => 'attendanceForDate', 'method' => 'post']) !!}
          {!! Form::select('schools', Config::get('schools.value'), null, ['class' => 'form-control col-sm-3']) !!}
    </div>
    <div class="form-group col-offset-2 col-md-2">
          {!! Form::text('attend_date', '', ['class' => 'form-control', 'id' => 'attend_date', 'placeholder' => '実績の日付を入力']) !!}
    </div>
    <div class="form-group col-offset-2 col-md-3">
          {!! Form::submit('検索', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>
  </div>
  <div class="container">
  　<div class="col col-md-offset-1 col-md-8">
      <nav class="panel panel-default">
        <div class="panel-heading">日付別出席者</div>
          <div class="panel-body">
            <table class="table">
                <thead>
                   <tr>
                        <th>日付</th>
                        <th>氏名</th>
                        <th>開始時間</th>
                        <th>終了時間</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($timecards as $timecard)
                    <tr class="table-td">
                        <td>{{ $timecard->attend_date->isoformat('YYYY/MM/DD') }}</td>
                        <td>{{ optional($timecard->user)->name }}</td>
                        <td>{{ mb_substr($timecard->punch_in, 0, 5 )}}</td>
                        <td>{{ mb_substr($timecard->punch_out, 0, 5 )}}</td>
                        <td><a href="{{ route('performanceRegisterByAttendDate', ['timecard_id' => $timecard->id] ) }}">新規実績登録</a><td>
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