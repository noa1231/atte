<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/index.css" />
</head>
<body>
  <header>
    <h1>Atte</h1>
    <nav class="header-nav">
      <ul class="header-nav-list">
        <li class="header-nav-item">
          <a href="" class="item">ホーム</a>
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
  <div class="main">
    <p class="user_name">{{ Auth::user()->name }}さんお疲れ様です!</p>
  
    <form method="POST" action="{{ route('start_work') }}">
      @csrf
      @if(isset($users->start_work))
      <input type="submit" value="勤務開始" class="start_work"  disabled>
      @else
      <input type="submit" value="勤務開始" class="start_work" >
      @endif
    </form>
    <form method="POST" action="{{ route('end_work') }}">
      @csrfz
      @if(isset($users->start_work) && !isset($users->end_work))
      <input type="submit" value="勤務終了" class="end_work">
      @else
      <input type="submit" value="勤務終了" class="end_work" disabled>
      @endif
    </form>
    <form method="POST" action="{{ route('start_rest') }}">
      @csrf
      @if(isset($users->start_work) && !isset($rests->start_rest))
      <input type="submit" value="休憩開始" class="start_rest">
      @elseif(isset($rests->end_rest) && !isset($users->end_work))
      <input type="submit" value="休憩開始" class="start_rest">
      @else
      <input type="submit" value="休憩開始" class="start_rest" disabled>
      @endif
    </form>
    <form method="POST" action="{{ route('end_rest') }}">
      @csrf
      @if(isset($rests->start_rest) && !isset($users->end_work))
      <input type="submit" value="休憩終了" class="end_rest">
      @else
      <input type="submit" value="休憩終了" class="end_rest" disabled>
      @endif
    </form>
  </div>
  <div class="log">
    <small>Atte,inc.</small>
  </div>
</body>
</html>