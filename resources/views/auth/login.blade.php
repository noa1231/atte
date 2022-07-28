<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="css/login.css" />
</head>
<body>
<div>
    <h1>Atte</h1>
    <div class="main">
        <div>
            <h2>ログイン</h2>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>         
                <x-input id="email" class="email" type="email" name="email" :value="old('email')" placeholder="メールアドレス" required autofocus /> 
            </div>

            <!-- Password -->
            <div class="mt-4">

                <x-input id="password" class="password" placeholder="パスワード"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    ログイン
                </x-button>
            </div>
        </form>
        <p class="message">アカウントをお持ちでない方はこちら</p>
        <a href="{{ route('register') }}" class="register">会員登録</a>
    </div>
    <div class="log">
        <small>Atte,inc.</small>
    </div>
</div>
</body>
</html>
