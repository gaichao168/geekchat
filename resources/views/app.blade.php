<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="https://image.gstatics.cn/icon/geekchat.png">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
    <div class="flex items-center justify-center">
        <div class="my-2 grid sm:grid-cols-1 gap-y-2 gap-x-6">
            <div class="flex items-center justify-start space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#3B82F6" d="M22.282 9.821a5.985 5.985 0 0 0-.516-4.91a6.046 6.046 0 0 0-6.51-2.9A6.065 6.065 0 0 0 4.981 4.18a5.985 5.985 0 0 0-3.998 2.9a6.046 6.046 0 0 0 .743 7.097a5.98 5.98 0 0 0 .51 4.911a6.051 6.051 0 0 0 6.515 2.9A5.985 5.985 0 0 0 13.26 24a6.056 6.056 0 0 0 5.772-4.206a5.99 5.99 0 0 0 3.997-2.9a6.056 6.056 0 0 0-.747-7.073zM13.26 22.43a4.476 4.476 0 0 1-2.876-1.04l.141-.081l4.779-2.758a.795.795 0 0 0 .392-.681v-6.737l2.02 1.168a.071.071 0 0 1 .038.052v5.583a4.504 4.504 0 0 1-4.494 4.494zM3.6 18.304a4.47 4.47 0 0 1-.535-3.014l.142.085l4.783 2.759a.771.771 0 0 0 .78 0l5.843-3.369v2.332a.08.08 0 0 1-.033.062L9.74 19.95a4.5 4.5 0 0 1-6.14-1.646zM2.34 7.896a4.485 4.485 0 0 1 2.366-1.973V11.6a.766.766 0 0 0 .388.676l5.815 3.355l-2.02 1.168a.076.076 0 0 1-.071 0l-4.83-2.786A4.504 4.504 0 0 1 2.34 7.872zm16.597 3.855l-5.833-3.387L15.119 7.2a.076.076 0 0 1 .071 0l4.83 2.791a4.494 4.494 0 0 1-.676 8.105v-5.678a.79.79 0 0 0-.407-.667zm2.01-3.023l-.141-.085l-4.774-2.782a.776.776 0 0 0-.785 0L9.409 9.23V6.897a.066.066 0 0 1 .028-.061l4.83-2.787a4.5 4.5 0 0 1 6.68 4.66zm-12.64 4.135l-2.02-1.164a.08.08 0 0 1-.038-.057V6.075a4.5 4.5 0 0 1 7.375-3.453l-.142.08L8.704 5.46a.795.795 0 0 0-.393.681zm1.097-2.365l2.602-1.5l2.607 1.5v2.999l-2.597 1.5l-2.607-1.5Z"></path>
                </svg>
                <div class="text-sm">
                    <a href="https://geekr.dev/posts/chatgpt-prompt-guide-1" class=" underline text-blue-400 hover:text-blue-500" target="_blank">
                        点击加入社群反馈问题、学习交流 ChatGPT 使用
                    </a>
                </div>
            </div>
        </div>


    </div>
    <section class="container mx-auto">
        <div class="grid grid-cols-1">
            <div class="py-8">
                <h1 class="text-center text-4xl pb-4">获取属于你的 OpenAI API 密钥</h1>
                <span class="block text-center text-2xl text-blue-600"><a href="https://faka.mianshijun.com">点击这里</a></span>
            </div>


            <div class="grid grid-cols-3 gap-4 my-16">
                <div class="col-span-3">
                    <h2 class="text-red-600 text-center text-2xl font-bold">特色服务</h2>
                </div>
                <div class="border rounded-md shadow-md p-4">
                    <a href="https://apps.apple.com/app/opencat/id6445999201" class="block">
                       <span class="flex text-xl font-bold">
                           <img class="h-6 w-6 rounded-lg bg-gray-50" src="https://is4-ssl.mzstatic.com/image/thumb/Purple126/v4/f7/09/07/f70907cf-9fce-1844-8402-0d56e904c97a/AppIcon-85-220-4-2x.png/460x0w.webp" alt="">
                        openchat
                       </span>
                        <span class="text-sm text-gray-400">
                            penCat 是一个 OpenAI 和 ChatGPT 的原生客户端，提供比 Web 界面更流畅和更快速的聊天体验。支持 MacOS 和 iOS。
                        </span>
                    </a>
                </div>
                <div class="border rounded-md shadow-md p-4">
                    <a href="https://apps.apple.com/app/opencat/id6445999201" class="block">
                       <span class="flex text-xl font-bold">
<img class="h-6 w-6 rounded-lg bg-gray-50" src="https://translator.lance.moe/favicon.png" alt="">
                           OpenAI 翻译器
                       </span>
                        <span class="text-sm text-gray-400">
                            PWA 应用，可以在手机上使用的翻译工具。
                        </span>
                    </a>
                </div>                <div class="border rounded-md shadow-md p-4">
                    <a href="https://apps.apple.com/app/opencat/id6445999201" class="block">
                       <span class="flex text-xl font-bold">
                      <img class="h-6 w-6 rounded-lg bg-gray-50" src="https://uploads-ssl.webflow.com/6402901a2a9eeaba148db81e/6402b710ab0458272618ac6a_Group%2037.png" alt="">
                           Zeeno
                       </span>
                        <span class="text-sm text-gray-400">
Zeeno 是一款生活在手机键盘中的 AI 助手。你可以在不离开手机聊天窗口的情况下重新表述推文、为下一顿家庭晚餐提供烹饪方案、生成对长邮件的回复等等。
                        </span>
                    </a>
                </div>                <div class="border rounded-md shadow-md p-4">
                    <a href="https://apps.apple.com/app/opencat/id6445999201" class="block">
                       <span class="flex text-xl font-bold">
                         <img class="h-6 w-6 rounded-lg bg-gray-50" src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="">
                           ChatGPT 微信
                       </span>
                        <span class="text-sm text-gray-400">
                            基于ChatGPT的微信聊天机器人，通过 ChatGPT 接口生成对话内容，使用 itchat 实现微信消息的接收和自动回复。支持文本对话、规则定制化、多账号、图片生成、上下文记忆。
                        </span>
                    </a>
                </div>
                <div class="border rounded-md shadow-md p-4">
                    <a href="https://apps.apple.com/app/opencat/id6445999201" class="block">
                       <span class="flex text-xl font-bold">
                           <img class="h-6 w-6 rounded-lg bg-gray-50" src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="">
                           xiaogpt
                       </span>
                        <span class="text-sm text-gray-400">
                           将小米的小爱同学和 ChatGPT 结合起来，实现了一个小爱同学的聊天机器人。
                        </span>
                    </a>
                </div>
                <div class="border rounded-md shadow-md p-4">
                    <a href="https://apps.apple.com/app/opencat/id6445999201" class="block">
                       <span class="flex text-xl font-bold">
                           <img class="h-6 w-6 rounded-lg bg-gray-50" src="https://fsys.app/favicon.ico" alt="">
                           风声雨声翻译
                       </span>
                        <span class="text-sm text-gray-400">
                            基于 gpt-3.5 的中英对照书籍翻译服务，高质量翻译，全本中英对照，企业级稳定翻译，全网原版书资源。
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </section>
    <footer class="text-center sm:text-left">
        <div class="p-4 text-center text-neutral-700">
            GeekChat 由
            <a href="https://geekr.dev" target="_blank" class="text-neutral-800 dark:text-neutral-400">极客书房</a>
            开发维护，定制开发、合作咨询请<a href="https://image.gstatics.cn/wechat.webp" target="_blank" class="text-blue-300 dark:text-blue-500">点这里</a>。
        </div>
    </footer>
</body>

</html>
