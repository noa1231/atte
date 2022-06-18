<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
          <a href="{{ route('show') }}" class="item">日付一覧</a>
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
  <table>
    <tr>
      <th>名前</th>
      <th>勤務開始</th>
      <th>勤務終了</th>
      <th>休憩時間</th>
      <th>休憩時間</th>
    </tr>
    @foreach ($items as $item)
    @foreach ($item->works as $work)
    <tr>
      <td>{{ $item->name }}</td>
      <td>{{ $work->start_work }}</td>
      <td>{{ $work->end_work }}</td>
      <td></td>
      <td></td>
    </tr>
    @endforeach
    @endforeach
  </table>
</body>
</html>