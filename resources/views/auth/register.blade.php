<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/register.css" />
</head>
<body>
    <h1>Atte</h1>
    <div class="main">
        <x-slot name="logo">
            <h2>会員登録</h2>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input id="name" class="name" type="text" name="name" :value="old('name')" placeholder="名前" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input id="email" class="email" type="email" name="email" :value="old('email')" placeholder="メールアドレス" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input id="password" class="password" placeholder="パスワード"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input id="password_confirmation" class="password_confirmation" placeholder="確認用パスワード"
                                type="password"
                                name="password_confirmation" required />
            </div>
            <x-button class="ml-4">
                    会員登録
                </x-button>
            <div class="flex items-center justify-end mt-4">
                <p class="message">アカウントをお持ちの方はこちら</p>
                <a href="{{ route('login') }}" class="login">
                    ログイン
                </a>
            </div>
        </form>
    </div>
    <div class="log">
        <small>Atte,inc.</small>
    </div>
</body>
</html>
