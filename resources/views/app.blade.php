<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="https://image.gstatics.cn/icon/geekchat.png">

    <title inertia>我的编程-@yield('title','首页')</title>
    <meta name="keyword" content="@yield('keyword','AIChat, 聊天机器人, 智能交互')">
    <!-- Fonts -->

    <!-- Scripts -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4193846562907716"
            crossorigin="anonymous"></script>
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
    @include('analytics')

</head>

<body class="font-sans antialiased">
<div class=" dark:bg-gray-700">
    @include('layouts.navigation')
</div>

@inertia

<footer class="">
    <div class="container mx-auto ">
        <div class="grid grid-cols-3">
            <div class="flex items-center justify-center text-center border-r border-teal-300">
                <ul class="space-y-1">
                    <li class="font-bold">友情连接</li>
                    <li><a href="https://wobcw.com" class="hover:text-teal-400 underline" target="_blank">我的编程网</a>
                    </li>
                    <li><a href="https://fanshijun.com" class="hover:text-teal-400 underline" target="_blank">面试网</a>
                    </li>
                    <li><a href="https://faka.fanshijun.com" class="hover:text-teal-400 underline" target="_blank">王朝数卡</a></li>
                </ul>
            </div>
            <div class="flex items-center justify-center text-center border-r border-teal-300">
                <ul>
                    <li class="font-bold">特别鸣谢</li>
                    <li>待定</li>
                </ul>
            </div>
            <div class="flex items-center justify-center text-center ">
                <ul>
                    <li class="font-bold">资源推荐</li>
                    <li><a href="https://uvfin6qskzu.feishu.cn/docx/JaMkdq2n8oxRJMxhzw5c8Dl7n7b" class="hover:text-teal-400 underline" target="_blank">GPT实用手册</a></li>
                </ul>
            </div>
        </div>
        <div class="p-4 text-center text-neutral-700">
            WoChat 由
            <a href="https://wobcw.com" target="_blank" class="text-teal-400 dark:text-neutral-400">我的编程网</a>
            开发维护，定制开发、合作咨询请<a href="{{asset('images/wechat_code.jpg')}}" target="_blank"
                                           class="text-blue-300 dark:text-blue-500">点这里</a>。
        </div>
    </div>

</footer>
</body>

</html>
