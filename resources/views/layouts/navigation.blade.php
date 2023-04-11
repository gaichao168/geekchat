<div class="border-b border-teal-400  dark:bg-gray-700">
    <nav class="container mx-auto flex justify-between items-center">
        <div class="flex items-center justify-center space-x-2">
            <img src="https://image.gstatics.cn/icon/geekchat.png" alt="GeekChat" class="rounded-lg w-12 h-12">
            <div class="font-semibold text-4xl sm:text-5xl dark:text-white">WO<span class="text-blue-500">Chat</span>
            </div>
        </div>
        <nav class="flex space-x-4 justify-start items-center">
            <a href="/" class="dark:text-white text-black py-3 px-4 hover:text-teal-500 hover:bg-gray-500">首页</a>
            <a href="/shares" title="知识科普" class="dark:text-white text-black py-3 px-4 hover:text-teal-500 hover:bg-gray-500">知识科普</a>
            <a href="/" class="dark:text-white text-black py-3 px-4 hover:text-teal-500 hover:bg-gray-500">联系我们</a>
        </nav>
        @if (Route::has('login'))
            <div class="">
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('dashboard')">
                                    {{ __('会员中心') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('个人资料') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('退出') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
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
