<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Estilos inline para garantir visual se o vite não estiver a correr */
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center justify-center min-h-screen">
    <div class="w-full max-w-[400px]">
        <div
            class="bg-white dark:bg-[#161615] p-8 rounded-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
            <h1 class="text-xl font-medium mb-6 dark:text-white">Entrar</h1>

            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Email</label>
                    <input type="email" id="email" name="email" required autofocus
                        class="w-full px-4 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#19140035] dark:border-[#3E3E3A] rounded-sm focus:outline-none focus:ring-1 focus:ring-[#f53003] dark:text-white">
                </div>

                <div class="mb-6">
                    <label for="password"
                        class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Palavra-passe</label>
                    <div class="flex flex-col">
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#19140035] dark:border-[#3E3E3A] rounded-sm focus:outline-none focus:ring-1 focus:ring-[#f53003] dark:text-white">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-xs text-[#f53003] dark:text-[#FF4433] mt-2 underline">Esqueceu-se da
                                palavra-passe?</a>
                        @endif
                    </div>
                </div>

                <div class="flex items-center mb-6">
                    <input type="checkbox" id="remember_me" name="remember"
                        class="w-4 h-4 border-[#19140035] dark:border-[#3E3E3A]">
                    <label for="remember_me" class="ml-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">Lembrar-me</label>
                </div>

                <button type="submit"
                    class="w-full py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm font-medium hover:opacity-90 transition-opacity">
                    Entrar
                </button>
            </form>

            @if (Route::has('register'))
                <p class="mt-6 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    Não tem conta?
                    <a href="{{ route('register') }}"
                        class="text-[#f53003] dark:text-[#FF4433] font-medium underline">Registe-se</a>
                </p>
            @endif
        </div>
    </div>
</body>

</html>
