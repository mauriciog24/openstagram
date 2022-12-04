<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PirateStagram - @yield('title')</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>

    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">
                    PirateStagram
                </h1>

                @auth
                    <nav class="flex gap-2 items-center">
                        <a class="font-bold text-gray-600 text-sm" href="#">
                            Hi,
                            <span class="font-normal">
                                {{ auth()->user()->username }}
                            </span>
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                                Logout
                            </button>
                        </form>
                    </nav>
                @endauth

                @guest
                    <nav class="flex gap-2 items-center">
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">
                            Login
                        </a>

                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">
                            Register
                        </a>
                    </nav>
                @endguest
            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('title')
            </h2>

            @yield('content')
        </main>

        <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            PirateStagram - All rights reserved {{ now()->year }}
        </footer>
    </body>
</html>
