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
        <div class="panel-body"> 
          <div class="panel-table-header">        
            <div class="panel-table-date-name">
              <span>日付</span>
              <span>曜日</span>
            </div>
            <div class="panel-table-category">
              <div class="panel-table-title">サービス提供実績</div>
              <span class="service">サービス確認状況</span>
              <span class="service">開始時間</span>
              <span class="service">終了時間</span>
              <span class="service">食事提供加算</span>
              <span class="service">施設外支援加算</span>
              <span class="service">医療連携体系加算</span>
            </div>
            <div class="panel-table-remarks">
              <span>備考</span>
              <span>利用者確認印</span>
            </div>
          </div>
              <div class="clear"></div>
            <div class="panel-records">
              @foreach (array_map(null, $days, $weeks, $records) as [$day, $week, $record])
                @if ($day == $record)
                <ul id="performances">  
                  <li id="attend_day">{{ ltrim($day->isoformat('DD'), "0") }}日</li>
                  <li id="attend_week">{{ $week->isoformat('ddd') }}</li>
                  <li id="service">欠</li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
                @else
                <ul id="performances">  
                  <li id="attend_day">{{ ltrim($day->isoformat('DD'), "0") }}日</li>
                  <li id="attend_week">{{ $week->isoformat('ddd') }}</li>
                  <li id="service"></li>
                  <li id="punch_in">{{ mb_substr($record->timecard->punch_in, 0,5) }}</li>
                  <li id="punch_out">{{ mb_substr($record->timecard->punch_out, 0,5) }}</li>
                  <li id="meal">{{ $record->meal_fg }}</li>
                  <li id="outside">{{ $record->outside_fg }}</li>
                  <li id="medical">{{ $record->medical_fg }}</li>
                  <li id="note"><span class="label {{ $record->note_class }}">{{ $record->note_label }}</span></li>
                </ul>
                @endif
              @endforeach
            </div>
        </nav>   
    </div>
  </div>
@endsection('content')