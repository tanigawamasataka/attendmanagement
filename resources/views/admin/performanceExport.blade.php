<table>
  <tr>
    <th></th>
    <th></th>
    <th></th>
    <th colspan="2">{{ $year }}年{{ $month }}月</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <tr>                                                          
    <th></th>
    <th colspan="3" style="vertical-align: center; text-align: center; border-bottom: 1px solid #000000; font-size: 9px;">支援決定障害者指名</th>
    <th colspan="5" rowspan="3" style="vertical-align: center; text-align: center; font-size: 16px;">実績記録表</th>
    <th colspan="2" style="vertical-align: center; text-align: center; border-bottom: 1px solid #000000; font-size: 9px;">事業者及びその事業所</th>
  </tr>
  <tr>
    <th></th>
    <th colspan="3" rowspan="2" style="vertical-align: center; text-align: center; font-size: 13px;">{{ $user->name }}</th>
    <th colspan="2" rowspan="2" style="vertical-align: center; text-align: center; font-size: 13px;">未来のかたち {{ $user->school->school_name }}</th>
  </tr>
  <tr></tr>
  <tr>
    <th></th>
    <th rowspan="3" style="vertical-align: center; text-align: center; font-size: 10px;">日付</th>
    <th rowspan="3" style="vertical-align: center; text-align: center; font-size: 10px;">曜日</th>
    <th colspan="6" style="vertical-align: center; text-align: center; border-bottom: 1px solid #000000; font-size: 9px;">サービス提供実績</th>
    <th rowspan="3" style="vertical-align: center; text-align: center; font-size: 10px;">備考</th>
    <th rowspan="3" style="vertical-align: center; text-align: center; font-size: 10px;">利用者<br>確認印</th>
  </tr>
  <tr>
    <th></th>
    <th rowspan="2" style="vertical-align: center; text-align: center; font-size: 9px;">サービス提供<br>の状況</th>
    <th rowspan="2" style="vertical-align: center; text-align: center; font-size: 9px;">開始時間</th>
    <th rowspan="2" style="vertical-align: center; text-align: center; font-size: 9px;">終了時間</th>
    <th rowspan="2" style="vertical-align: center; text-align: center; font-size: 9px;">食事提供<br>加算</th>
    <th rowspan="2" style="vertical-align: center; text-align: center; font-size: 9px;">施設外支援<br>加算</th>
    <th rowspan="2" style="vertical-align: center; text-align: center; font-size: 9px;">医療連携<br>体系加算</th>
  </tr>
  <tr></tr>
  @foreach (array_map(null, $days, $weeks, $records) as [$day, $week, $record])
    @if ($day == $record)
    <tr>
      <td></td>
      <td style="vertical-align: center; text-align: center; font-size: 10px;">{{ ltrim($day->isoformat('DD'), "0") }}日</td>
      <td style="vertical-align: center; text-align: center; font-size: 10px;">{{ $week->isoformat('ddd') }}</td>
      <td style="vertical-align: center; text-align: center; font-size: 10px;">欠</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    @else
    <tr>
      <td></td>
      <td style="vertical-align: center; text-align: center; font-size: 10px;">{{ ltrim($day->isoformat('DD'), "0") }}日</td>
      <td style="vertical-align: center; text-align: center; font-size: 10px;">{{ $week->isoformat('ddd') }}</td>
      <td></td>
      <td style="vertical-align: center; text-align: center;">{{ mb_substr($record->timecard->punch_in, 0,5) }}</td>
      <td style="vertical-align: center; text-align: center;">{{ mb_substr($record->timecard->punch_out, 0,5) }}</td>
      <td style="vertical-align: center; text-align: center;">{{ $record->meal_fg }}</td>
      <td style="vertical-align: center; text-align: center;">{{ $record->outside_fg }}</td>
      <td style="vertical-align: center; text-align: center;">{{ $record->medical_fg }}</td>
      <td style="vertical-align: center; text-align: center; font-size: 10px;"><span class="label {{ $record->note_class }}">{{ $record->note_label }}</span></td>
    </tr>
    @endif
  @endforeach
</table>