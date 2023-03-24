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
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>

</head>
@include('analytics')
<body class="font-sans antialiased">
@inertia
<section class="container mx-auto">
    <div class="grid grid-cols-1">
        <div class="py-8">
            <h1 class="text-center md:text-4xl text-2xl px-4">获取属于你的 OpenAI API 密钥</h1>

            <h3 class="text-center text-gray-400 pb-4 ">独立通道，数据安全</h3>

            <span class="block text-center text-2xl my-2">
                <a class="bg-blue-400 rounded-md  text-white px-4 py-2 hover:bg-blue-800"
                   href="https://faka.mianshijun.com" target="_blank">点击这里</a>
            </span>
        </div>

    </div>
    <div class="py-8">
        <h1 class="text-4xl text-center font-bold">正经聊天指南</h1>
        <div class="grid gap-2 mt-4">
            <div class="border p-4 rounded-md shadow-md">
                <h2 class="font-bold text-2xl border-b">担任编剧</h2>
                <div class="indent-8">
                    我要你担任编剧。您将为长篇电影或能够吸引观众的网络连续剧开发引人入胜且富有创意的剧本。从想出有趣的角色、故事的背景、角色之间的对话等开始。一旦你的角色发展完成——创造一个充满曲折的激动人心的故事情节，让观众一直悬念到最后。我的第一个要求是“我需要写一部以巴黎为背景的浪漫剧情电影”。
                </div>
            </div>
            <div class="border p-4 rounded-md shadow-md">
                <h2 class="font-bold text-2xl border-b">充当励志演讲者</h2>
                <div class="indent-8">
                    我希望你充当励志演说家。将能够激发行动的词语放在一起，让人们感到有能力做一些超出他们能力的事情。你可以谈论任何话题，但目的是确保你所说的话能引起听众的共鸣，激励他们努力实现自己的目标并争取更好的可能性。我的第一个请求是“我需要一个关于每个人如何永不放弃的演讲”。
                </div>
            </div>
            <div class="border p-4 rounded-md shadow-md">
                <h2 class="font-bold text-2xl border-b">担任厨师</h2>
                <div class="indent-8">
                    我需要有人可以推荐美味的食谱，这些食谱包括营养有益但又简单又不费时的食物，因此适合像我们这样忙碌的人以及成本效益等其他因素，因此整体菜肴最终既健康又经济！我的第一个要求——“一些清淡而充实的东西，可以在午休时间快速煮熟”
                </div>
            </div>
            <div class="border p-4 rounded-md shadow-md">
                <h2 class="font-bold text-2xl border-b">担任营养师</h2>
                <div class="indent-8">
                    作为一名营养师，我想为 2 人设计一份素食食谱，每份含有大约 500 卡路里的热量并且血糖指数较低。你能提供一个建议吗？
                </div>
            </div>
        </div>
    </div>
<div>
    <amp-ad width="100vw" height="320"
            type="adsense"
            data-ad-client="ca-pub-4193846562907716"
            data-ad-slot="8753144254"
            data-auto-format="rspv"
            data-full-width="">
        <div overflow=""></div>
    </amp-ad>
</div>
    <div class="hidden md:block w-1/2 py-8 mx-auto">
        <h1 class="text-center text-4xl font-bold">感谢赞助</h1>
        <span class="block text-sm text-center text-gray-400">生活不易，感谢支持</span>
        <div class="flex space-x-2 mt-4 justify-center items-center">
            <div class="w-48 h-48 border rounded-md shadow-md overflow-hidden">
                <img src="{{asset('images/wechat_pay_code.png')}}" alt="">
            </div>
            <div class="w-48  h-48 border rounded-md shadow-md overflow-hidden">
                <img src="{{asset('images/alipay_code.png')}}" alt="">
            </div>
        </div>
    </div>
    <div class="grid md:grid-cols-4 grid-cols-2 gap-4 my-16">
        <div class=" md:col-span-4 col-span-2">
            <h2 class="text-red-600 text-center text-2xl font-bold">特色服务</h2>
        </div>
        <div class="border rounded-md shadow-md p-4">
            <a href="https://apps.apple.com/app/opencat/id6445999201" target="_blank" class="block">
                       <span class="flex text-xl font-bold">
                           <img class="h-6 w-6 rounded-lg bg-gray-50"
                                src="https://is4-ssl.mzstatic.com/image/thumb/Purple126/v4/f7/09/07/f70907cf-9fce-1844-8402-0d56e904c97a/AppIcon-85-220-4-2x.png/460x0w.webp"
                                alt="">
                        openchat
                       </span>
                <span class="text-sm text-gray-400">
                            penCat 是一个 OpenAI 和 ChatGPT 的原生客户端，提供比 Web 界面更流畅和更快速的聊天体验。支持 MacOS 和 iOS。
                        </span>
            </a>
        </div>
        <div class="border rounded-md shadow-md p-4">
            <a href="https://apps.apple.com/app/opencat/id6445999201" target="_blank" class="block">
                       <span class="flex text-xl font-bold">
<img class="h-6 w-6 rounded-lg bg-gray-50" src="https://translator.lance.moe/favicon.png" alt="">
                           OpenAI 翻译器
                       </span>
                <span class="text-sm text-gray-400">
                            PWA 应用，可以在手机上使用的翻译工具。
                        </span>
            </a>
        </div>
        <div class="border rounded-md shadow-md p-4">
            <a href="https://apps.apple.com/app/opencat/id6445999201" target="_blank" class="block">
                       <span class="flex text-xl font-bold">
                      <img class="h-6 w-6 rounded-lg bg-gray-50"
                           src="https://uploads-ssl.webflow.com/6402901a2a9eeaba148db81e/6402b710ab0458272618ac6a_Group%2037.png"
                           alt="">
                           Zeeno
                       </span>
                <span class="text-sm text-gray-400">
Zeeno 是一款生活在手机键盘中的 AI 助手。你可以在不离开手机聊天窗口的情况下重新表述推文、为下一顿家庭晚餐提供烹饪方案、生成对长邮件的回复等等。
                        </span>
            </a>
        </div>
        <div class="border rounded-md shadow-md p-4">
            <a href="https://apps.apple.com/app/opencat/id6445999201" target="_blank" class="block">
                       <span class="flex text-xl font-bold">
                         <img class="h-6 w-6 rounded-lg bg-gray-50"
                              src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="">
                           ChatGPT 微信
                       </span>
                <span class="text-sm text-gray-400">
                            基于ChatGPT的微信聊天机器人，通过 ChatGPT 接口生成对话内容，使用 itchat 实现微信消息的接收和自动回复。支持文本对话、规则定制化、多账号、图片生成、上下文记忆。
                        </span>
            </a>
        </div>
        <div class="border rounded-md shadow-md p-4">
            <a href="https://apps.apple.com/app/opencat/id6445999201" target="_blank" class="block">
                       <span class="flex text-xl font-bold">
                           <img class="h-6 w-6 rounded-lg bg-gray-50"
                                src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="">
                           xiaogpt
                       </span>
                <span class="text-sm text-gray-400">
                           将小米的小爱同学和 ChatGPT 结合起来，实现了一个小爱同学的聊天机器人。
                        </span>
            </a>
        </div>
        <div class="border rounded-md shadow-md p-4">
            <a href="https://apps.apple.com/app/opencat/id6445999201" target="_blank" class="block">
                       <span class="flex text-xl font-bold">
                           <img class="h-6 w-6 rounded-lg bg-gray-50" src="https://fsys.app/favicon.ico" alt="">
                           风声雨声翻译
                       </span>
                <span class="text-sm text-gray-400">
                            基于 gpt-3.5 的中英对照书籍翻译服务，高质量翻译，全本中英对照，企业级稳定翻译，全网原版书资源。
                        </span>
            </a>
        </div>
        <div class="border rounded-md shadow-md p-4">
            <a href="https://apps.apple.com/app/opencat/id6445999201" target="_blank" class="block">
                       <span class="flex text-xl font-bold">
                           <img class="h-6 w-6 rounded-lg bg-gray-50" src="https://www.notion.so/images/favicon.ico"
                                alt="">
                           ChatGPT商务速成
                       </span>
                <span class="text-sm text-gray-400">
                            在商务业务中使用 ChatGPT 来提高效率的方法技巧汇总，主要教你如何用 ChatGPT 变现。
                        </span>
            </a>
        </div>
        <div class="border rounded-md shadow-md p-4">
            <a href="https://apps.apple.com/app/opencat/id6445999201" target="_blank" class="block">
                       <span class="flex text-xl font-bold">
                           <img class="h-6 w-6 rounded-lg bg-gray-50"
                                src="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🐣</text></svg>"
                                alt="">
                           BibiGPT
                       </span>
                <span class="text-sm text-gray-400">
                            一键总结 Bilibili、YouTube、播客、会议等音视频内容。
                        </span>
            </a>
        </div>
    </div>

</section>
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
