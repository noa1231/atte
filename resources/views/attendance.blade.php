<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atte</title>
  <link rel="stylesheet" href="{{ asset('css/attendance.css') }}" >
</head>
<body>         
  <header>
    <h1>Atte</h1>
    <nav class="header-nav">
      <ul class="header-nav-list">
        <li class="header-nav-item">
          <a href="{{ route('index') }}" class="item">ホーム</a>
        </li>
        <li class="header-nav-item">
          <a href="/attendance/0" class="item">日付一覧</a>
        </li>
        <li class="header-nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();" class="item">
                ログアウト
            </a>
          </form>
        </li> 
      </ul>
    </nav>
  </header>
  <div class="main">
    <div class="day">
      <a class="left" href="{!! '/attendance/' . ($num - 1) !!}">&lt;</a>
      <p>&nbsp;</p>
      <p class="date">{{ $date->format('Y-m-d') }}</p>
      <p>&nbsp;</p>
      <a class="right" href="{!! '/attendance/' . ($num + 1) !!}">&gt;</a>
    </div>
    <table>
      <tr class="form"> 
        <th>名前</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
      </tr>
      @foreach ($items as $item)
      <tr class="form_item">
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->start_work }}</td>
        <td>{{ $item->end_work }}</td>
        <td>{{ $item->rest_sum }}</td>
        <td>{{ $item->work_time }}</td>
      </tr>
      @endforeach
    </table>
    <div class="page">
      {{ $items->links() }}
    </div>
  </div>
  <div class="log">
    <small>Atte,inc.</small>
  </div>
</body>
</html>