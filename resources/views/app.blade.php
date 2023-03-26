<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="https://image.gstatics.cn/icon/geekchat.png">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
    @include('analytics')

</head>

<body class="font-sans antialiased">
<div class="border-b border-teal-400  dark:bg-gray-700">
    <nav class=" container mx-auto flex justify-between items-center">
        <div class="flex items-center justify-center space-x-2">
            <img src="https://image.gstatics.cn/icon/geekchat.png" alt="GeekChat" class="rounded-lg w-12 h-12">
            <div class="font-semibold text-4xl sm:text-5xl dark:text-white">AI<span class="text-blue-500">Chat</span>
            </div>
        </div>
        @if (Route::has('login'))
            <div class="">
                @auth
                    <a href="{{ url('/home') }}"
                       class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                @else
                    <a href="{{ route('login') }}"
                       class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-teal-400">登录</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-teal-400">注册</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>
</div>

@inertia

<footer class="text-center sm:text-left">
    <div class="p-4 text-center text-neutral-700">
        AIChat 由
        <a href="https://wobcw.com" target="_blank" class="text-neutral-800 dark:text-neutral-400">我的编程网</a>
        开发维护，定制开发、合作咨询请<a href="{{asset('images/wechat_code.jpg')}}" target="_blank"
                                       class="text-blue-300 dark:text-blue-500">点这里</a>。
    </div>
</footer>
</body>

</html>
