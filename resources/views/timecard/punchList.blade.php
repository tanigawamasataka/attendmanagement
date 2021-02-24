@extends('layout')

@section('content')
  <div class="text">
    ・{{ $current_school_name }}
    <span>ID : {{ $current_user_id }}</span>
    <span>氏名 : {{ $current_user_name }}</span>
  </div>
  <div class="text">・タイムカードを打刻してください</div>
  <div class="container">
    <div class="col col-md-offset-3 col-md-5">
      <nav class="panel panel-default">
        <div class="panel-heading">{{ \Carbon\Carbon::now()->format("Y年m月") }}</div>
          <div class="panel-body">
            <table class="table">
                <thead>
                  <tr>
                    <th>日付</th>
                    <th>曜日</th>
                    <th>開始時間</th>
                    <th>終了時間</th>
                    <th></th>
                  </tr>
                </thead>
                @foreach (array_map(null, $days, $weeks, $records) as [$day, $week, $record])
                <tbody>
                  <tr>
                    @if ($day == $record) 
                    <td class="date">{{ ltrim($day->isoformat('DD'), "0") }}日</td>
                    <td>{{ $week->isoformat('ddd') }}</td> 
                    <td id="absence">
                      @if ($day < $today)
                        欠
                      @endif
                   </td>
                    <td></td>
                    <td>
                      @if ($day == $today)
                      <form action="{{ route('timecard/punchIn', ['user_id' => $current_user_id]) }}" method="POST">
                        @method('POST')
                        @csrf
                        <button type="submit" class="btn btn-primary">出席</button>
                      </form>
                      @endif
                    </td>
                    @else
                    <td class="date">{{ ltrim($day->isoformat('DD'), "0") }}日</td>
                    <td>{{ $record->attend_date->isoformat('ddd') }}</td> 
                    <td>{{ substr( $record->punch_in, 0, 5) }}</td>
                    <td>{{ substr( $record->punch_out, 0, 5) }}</td>
                    <td>
                      @if ($day == $today && $record->status == 2)
                      <form action="{{ route('timecard/punchOut', ['user_id' => $current_user_id]) }}" method="POST">
                        @method('POST')
                        @csrf
                        <button type="submit" class="btn btn-danger">退席</button>
                      </form>
                      @elseif ($day == $today && $record->status == 3)
                      <p>退席済</p>
                      @endif
                    </td>
                    @endif
                  </tr>  
                </tbody>
                @endforeach
                @include('commons.messages')
            </table> 
          </div>
          <div class="panel-body">
            
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection('content')