@extends('/admin/layoutAdmin')

@section('content')
  <div class="container" id="container-top">
    <div>{{$year}}年{{ltrim($month, "0")}}月分</div>
    <a class="btn btn-primary" href="{{ route('performanceExport', ['user_id' => $user->id, 'timecard_id' => $timecard_id] )}}">Excel出力</a>
    <a href="{{ route('performanceManagement' )}}" class="btn btn-primary">実績一覧</a>
  </div>
  <div class="container">
    <div class="col col-md-offset-0col-md-12">
      <nav class="panel panel-default">
        <div class="panel-heading panel-heading-custom">
          <div id="panel-header-left">
            <div class="panel-header-label">支援決定障害者氏名</div>
            <div id="panel-header-name">{{ $user->name }}</div>
          </div>
          <div id="panel-header-title">実績記録表</div>
          <div id="panel-header-right">
            <div class="panel-header-label">事業者及びその事業所</div>
            <div id="panel-header-school-name">未来のかたち {{ $user->school->school_name }}</div>
          </div>
        </div>
        <table id="performance_table"> 
          <thead class="panel-table-header">        
            <tr class="panel-table-title">
              <th id="attend_day" rowspan="2">日付</th>
              <th id="attend_week" rowspan="2">曜日</th>
              <th id="service_offer" colspan="5">サービス提供実績</th>
              <th></th>
              <th id="note" rowspan="2">備考</th>
              <th id="stamp" rowspan="2">利用者確認印</th>
            </tr>
            <tr class="panel-table-service">  
              <th id="service_confirm">サービス確認状況</th>
              <th id="punch_in">開始時間</th>
              <th id="punch_out">終了時間</th>
              <th id="meal">食事提供加算</th>
              <th id="outside">施設外支援加算</th>
              <th id="medical">医療連携体系加算</th>
            </tr>
          </thead>
          <tbody>
          @foreach (array_map(null, $days, $weeks, $records) as [$day, $week, $record])
            @if ($day == $record)
            <tr id="performances">  
              <td id="input_attend_day">{{ ltrim($day->isoformat('DD'), "0") }}日</td>
              <td id="input_attend_week">{{ $week->isoformat('ddd') }}</td>
              <td id="input_service_confirm">欠</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            @else
            <tr id="performances">
              <td id="input_attend_day">{{ ltrim($day->isoformat('DD'), "0") }}日</td>
              <td id="input_attend_week">{{ $week->isoformat('ddd') }}</td>
              <td id="input_service_confirm"></td>
              <td id="input_punch_in">{{ mb_substr($record->timecard->punch_in, 0,5) }}</td>
              <td id="input_punch_out">{{ mb_substr($record->timecard->punch_out, 0,5) }}</td>
              <td id="input_meal">{{ $record->meal_fg }}</td>
              <td id="input_outside">{{ $record->outside_fg }}</td>
              <td id="input_medical">{{ $record->medical_fg }}</td>
              <td id="input_note"><span class="label {{ $record->note_class }}">{{ $record->note_label }}</span></td>
              <td></td>
            </tr>
            @endif
          @endforeach
          </tbody>
        </table>
      </nav>   
    </div>
  </div>
@endsection('content')