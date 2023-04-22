<div class="border-b border-teal-400  dark:bg-gray-700">
    <nav class="container mx-auto flex justify-between items-center">
        <div class="flex items-center justify-center space-x-2">
            {{--            <img src="https://image.gstatics.cn/icon/geekchat.png" alt="GeekChat" class="rounded-lg w-12 h-12">--}}
            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 overflow-hidden rounded-full basis-12 mr-2">
                <span class="text-[32px] dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" width="1em"
                         height="1em">
                        <path
                            d="M29.71,13.09A8.09,8.09,0,0,0,20.34,2.68a8.08,8.08,0,0,0-13.7,2.9A8.08,8.08,0,0,0,2.3,18.9,8,8,0,0,0,3,25.45a8.08,8.08,0,0,0,8.69,3.87,8,8,0,0,0,6,2.68,8.09,8.09,0,0,0,7.7-5.61,8,8,0,0,0,5.33-3.86A8.09,8.09,0,0,0,29.71,13.09Zm-12,16.82a6,6,0,0,1-3.84-1.39l.19-.11,6.37-3.68a1,1,0,0,0,.53-.91v-9l2.69,1.56a.08.08,0,0,1,.05.07v7.44A6,6,0,0,1,17.68,29.91ZM4.8,24.41a6,6,0,0,1-.71-4l.19.11,6.37,3.68a1,1,0,0,0,1,0l7.79-4.49V22.8a.09.09,0,0,1,0,.08L13,26.6A6,6,0,0,1,4.8,24.41ZM3.12,10.53A6,6,0,0,1,6.28,7.9v7.57a1,1,0,0,0,.51.9l7.75,4.47L11.85,22.4a.14.14,0,0,1-.09,0L5.32,18.68a6,6,0,0,1-2.2-8.18Zm22.13,5.14-7.78-4.52L20.16,9.6a.08.08,0,0,1,.09,0l6.44,3.72a6,6,0,0,1-.9,10.81V16.56A1.06,1.06,0,0,0,25.25,15.67Zm2.68-4-.19-.12-6.36-3.7a1,1,0,0,0-1.05,0l-7.78,4.49V9.2a.09.09,0,0,1,0-.09L19,5.4a6,6,0,0,1,8.91,6.21ZM11.08,17.15,8.38,15.6a.14.14,0,0,1-.05-.08V8.1a6,6,0,0,1,9.84-4.61L18,3.6,11.61,7.28a1,1,0,0,0-.53.91ZM12.54,14,16,12l3.47,2v4L16,20l-3.47-2Z"
                            fill="currentColor"></path>
                    </svg>
                </span>
            </div>
            <div class="font-semibold text-4xl sm:text-5xl dark:text-white">Wo<span class="text-blue-500">Chat</span>

            </div>
        </div>
        <nav class="flex space-x-4 justify-start items-center">
            <a href="/" class="dark:text-white text-black py-3 px-4 hover:text-teal-500 hover:bg-gray-500">首页</a>
            <a href="https://prompting.wobcw.com" title="学习AI提示" target="_blank"
               class="dark:text-white text-black py-3 px-4 hover:text-teal-500 hover:bg-gray-500">学习提示</a>
            <a href="/shares" title="知识科普"
               class="dark:text-white text-black py-3 px-4 hover:text-teal-500 hover:bg-gray-500">知识科普</a>
            <a href="{{asset('/images/wechat_code.jpg')}}"
               class="dark:text-white text-black py-3 px-4 hover:text-teal-500 hover:bg-gray-500">联系我们</a>
        </nav>
        {{--        @if (Route::has('login'))--}}
        {{--            <div class="">--}}
        {{--                @auth--}}
        {{--                    <div class="hidden sm:flex sm:items-center sm:ml-6">--}}
        {{--                        <x-dropdown align="right" width="48">--}}
        {{--                            <x-slot name="trigger">--}}
        {{--                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">--}}
        {{--                                    <div>{{ Auth::user()->name }}</div>--}}

        {{--                                    <div class="ml-1">--}}
        {{--                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
        {{--                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
        {{--                                        </svg>--}}
        {{--                                    </div>--}}
        {{--                                </button>--}}
        {{--                            </x-slot>--}}

        {{--                            <x-slot name="content">--}}
        {{--                                <x-dropdown-link :href="route('dashboard')">--}}
        {{--                                    {{ __('会员中心') }}--}}
        {{--                                </x-dropdown-link>--}}
        {{--                                <x-dropdown-link :href="route('profile.edit')">--}}
        {{--                                    {{ __('个人资料') }}--}}
        {{--                                </x-dropdown-link>--}}

        {{--                                <!-- Authentication -->--}}
        {{--                                <form method="POST" action="{{ route('logout') }}">--}}
        {{--                                    @csrf--}}

        {{--                                    <x-dropdown-link :href="route('logout')"--}}
        {{--                                                     onclick="event.preventDefault();--}}
        {{--                                                this.closest('form').submit();">--}}
        {{--                                        {{ __('退出') }}--}}
        {{--                                    </x-dropdown-link>--}}
        {{--                                </form>--}}
        {{--                            </x-slot>--}}
        {{--                        </x-dropdown>--}}
        {{--                    </div>--}}
        {{--                @else--}}
        {{--                    <a href="{{ route('login') }}"--}}
        {{--                       class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-teal-400">登录</a>--}}

        {{--                    @if (Route::has('register'))--}}
        {{--                        <a href="{{ route('register') }}"--}}
        {{--                           class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-teal-400">注册</a>--}}
        {{--                    @endif--}}
        {{--                @endauth--}}
        {{--            </div>--}}
        {{--        @endif--}}
    </nav>
</div>
