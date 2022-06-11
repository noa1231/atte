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
          <a href="" class="item">ホーム</a>
        </li>
        <li class="header-nav-item">
          <a href="" class="item">日付一覧</a>
        </li>
        <li class="header-nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                ログアウト
            </x-dropdown-link>
          </form>
        </li>
      </ul>
    </nav>
  </header>
  <div class="main">
    <form method="POST" action="{{ route('start_work') }}">
      @csrf
      <input type="submit" value="勤務開始" class="start_work">
    </form>
    <input type="submit" value="勤務終了" class="end_work">
    <input type="submit" value="休憩開始" class="start_rest">
    <input type="submit" value="休憩終了" class="end_rest">  
  </div>
  <div class="log">
    <small>Atte,inc.</small>
  </div>
</body>
</html>