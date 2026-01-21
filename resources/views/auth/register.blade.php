<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registo - {{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center justify-center min-h-screen">
    <div class="w-full max-w-[400px]">
        <div
            class="bg-white dark:bg-[#161615] p-8 rounded-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
            <h1 class="text-xl font-medium mb-6 dark:text-white">Criar Conta</h1>

            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Nome</label>
                    <input type="text" id="name" name="name" :value="old('name')" required autofocus
                        class="w-full px-4 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#19140035] dark:border-[#3E3E3A] rounded-sm focus:outline-none focus:ring-1 focus:ring-[#f53003] dark:text-white">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Email</label>
                    <input type="email" id="email" name="email" :value="old('email')" required
                        class="w-full px-4 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#19140035] dark:border-[#3E3E3A] rounded-sm focus:outline-none focus:ring-1 focus:ring-[#f53003] dark:text-white">
                </div>

                <div class="mb-4">
                    <label for="password"
                        class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Palavra-passe</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#19140035] dark:border-[#3E3E3A] rounded-sm focus:outline-none focus:ring-1 focus:ring-[#f53003] dark:text-white">
                </div>

                <div class="mb-6">
                    <label for="password_confirmation"
                        class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Confirmar Palavra-passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-2 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#19140035] dark:border-[#3E3E3A] rounded-sm focus:outline-none focus:ring-1 focus:ring-[#f53003] dark:text-white">
                </div>

                <button type="submit"
                    class="w-full py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm font-medium hover:opacity-90 transition-opacity">
                    Registar
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                Já tem conta?
                <a href="{{ route('login') }}" class="text-[#f53003] dark:text-[#FF4433] font-medium underline">Entre
                    aqui</a>
            </p>
        </div>
    </div>
</body>

</html>
