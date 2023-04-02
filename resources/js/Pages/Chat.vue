<script setup>
import AudioWidget from '@/Components/AudioWidget.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import {useStore} from 'vuex';
import {computed, onMounted} from 'vue';

// 消息列表初始化
const store = useStore()
onMounted(() => {
    store.dispatch('initMessages')
})

const messages = computed(() => store.state.messages.filter(message => message != undefined))
const isTyping = computed(() => store.state.isTyping)
const apiKey = computed(() => store.state.apiKey ? '*'.repeat(4) + store.state.apiKey.substr(length - 4, 4) : '')
const lastMessage = computed(() => store.state.lastMessage)
const lastAction = computed(() => store.state.lastAction)
const totalUsed = computed(() => store.state.totalUsed)
const totalGranted = computed(() => store.state.totalGranted)
const totalAvailable = computed(() => store.state.totalAvailable)
const isAmount = computed(() => store.state.isAmount)
const isNotice = computed(() => store.state.isNotice)
const form = useForm({
    prompt: null
})

const amount = useForm({
    amountKye: null
});

const chat = () => {
    if (isTyping.value) {
        return;
    }
    store.dispatch('chatMessage', {message: form.prompt})
    form.reset()
}

const reset = () => {
    store.dispatch('clearMessages')
    form.reset()
}

const audio = (blob) => {
    if (isTyping.value) {
        return;
    }
    store.dispatch('audioMessage', blob)
}

const audioFailed = (error) => {
    store.commit('addMessage', {
        role: 'assistant',
        content: error
    })
}

const image = () => {
    if (!form.prompt) {
        alert('请在输入框输入图片描述信息')
        return
    }
    if (isTyping.value) {
        return;
    }
    store.dispatch('imageMessage', {message: form.prompt})
    form.reset()
}

const translate = () => {
    if (!form.prompt) {
        alert('请在输入框输入待翻译内容')
        return
    }
    if (isTyping.value) {
        return;
    }
    store.dispatch('translateMessage', {message: form.prompt})
    form.reset()
}

const enterApiKey = () => {
    const api_key = prompt("输入你的 OpenAI API KEY（使用自己的 KEY 可以不受共享通道频率限制，还可以绘制大尺寸图片）：");
    store.dispatch('validAndSetApiKey', api_key)
}

const getAmount = () => {

    if (isTyping.value) {
        return;
    }
    store.dispatch('getAmount', amount.amountKye)
}

const getNotice = () => {
    store.dispatch('getNotice')
}
const regenerate = () => {
    if (!lastMessage.value || !lastAction.value) {
        return
    }
    switch (lastAction.value) {
        case "chat":
            store.dispatch('chatMessage', {message: lastMessage.value, regen: true})
            break
        case "image":
            store.dispatch('imageMessage', {message: lastMessage.value, regen: true})
            break
        case "translate":
            store.dispatch('translateMessage', {message: lastMessage.value, regen: true})
            break
        case "audio":
            store.dispatch('chatMessage', {message: lastMessage.value, regen: true})
            break
        default:
            alert('未知消息类型')
            break
    }
}

</script>

<template>
    <Head title="Chat - 支持文字、语音、翻译、画图的聊天机器人"></Head>
    <div>
        <div class="max-w-5xl mx-auto">
            <div>
                <div class="p-3 sm:p-5 flex items-center justify-center">
                    <div>

                        <div class="text-center my-4 font-light text-base sm:text-xl my-2 sm:my-5">支持文字、翻译、画图的聊天机器人
                        </div>
                        <div>
                            <div class="text-sm text-center">
                                <div>
                                    <button v-if="apiKey" @click="enterApiKey"
                                            class="text-blue-500 hover:underline font-semibold inline-flex space-x-2 disabled:text-gray-500">
                                        <svg
                                            stroke="currentColor" fill="currentColor" stroke-width="0"
                                            viewBox="0 0 512 512"
                                            class="w-5 h-5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M218.1 167.17c0 13 0 25.6 4.1 37.4-43.1 50.6-156.9 184.3-167.5 194.5a20.17 20.17 0 00-6.7 15c0 8.5 5.2 16.7 9.6 21.3 6.6 6.9 34.8 33 40 28 15.4-15 18.5-19 24.8-25.2 9.5-9.3-1-28.3 2.3-36s6.8-9.2 12.5-10.4 15.8 2.9 23.7 3c8.3.1 12.8-3.4 19-9.2 5-4.6 8.6-8.9 8.7-15.6.2-9-12.8-20.9-3.1-30.4s23.7 6.2 34 5 22.8-15.5 24.1-21.6-11.7-21.8-9.7-30.7c.7-3 6.8-10 11.4-11s25 6.9 29.6 5.9c5.6-1.2 12.1-7.1 17.4-10.4 15.5 6.7 29.6 9.4 47.7 9.4 68.5 0 124-53.4 124-119.2S408.5 48 340 48s-121.9 53.37-121.9 119.17zM400 144a32 32 0 11-32-32 32 32 0 0132 32z">
                                            </path>
                                        </svg>
                                        <span>修改 API Key ({{ apiKey }})</span></button>
                                    <button v-else @click="enterApiKey"
                                            class="inline-flex items-center justify-center rounded-full px-4 py-3 text-sm shadow-md bg-blue-300 text-white hover:bg-blue-500 transition-all active:bg-blue-600 group font-semibold text-sm disabled:bg-gray-400 space-x-2">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                             viewBox="0 0 512 512" class="w-5 h-5" height="1em" width="1em"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M218.1 167.17c0 13 0 25.6 4.1 37.4-43.1 50.6-156.9 184.3-167.5 194.5a20.17 20.17 0 00-6.7 15c0 8.5 5.2 16.7 9.6 21.3 6.6 6.9 34.8 33 40 28 15.4-15 18.5-19 24.8-25.2 9.5-9.3-1-28.3 2.3-36s6.8-9.2 12.5-10.4 15.8 2.9 23.7 3c8.3.1 12.8-3.4 19-9.2 5-4.6 8.6-8.9 8.7-15.6.2-9-12.8-20.9-3.1-30.4s23.7 6.2 34 5 22.8-15.5 24.1-21.6-11.7-21.8-9.7-30.7c.7-3 6.8-10 11.4-11s25 6.9 29.6 5.9c5.6-1.2 12.1-7.1 17.4-10.4 15.5 6.7 29.6 9.4 47.7 9.4 68.5 0 124-53.4 124-119.2S408.5 48 340 48s-121.9 53.37-121.9 119.17zM400 144a32 32 0 11-32-32 32 32 0 0132 32z">
                                            </path>
                                        </svg>
                                        <span>输入 API Key（可选）</span>
                                    </button>
                                    <span class="block pt-4 text-gray-600">私人API Key无限制</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 rounded-lg mb-4" v-for="(message, index) in messages" :key="index">
                    <div v-if="message && message.role == 'user'"
                         class="pl-12 relative response-block scroll-mt-32 min-h-[40px]">
                        <div class="absolute top-0 left-0">
                            <div
                                class="w-9 h-9 bg-gray-200 rounded-md  flex-none flex items-center justify-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6">
                                    <path fill-rule="evenodd"
                                          d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="w-full">
                            <markdown :source="message.content"
                                      class="text-sm space-y-2 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg max-w-full overflow-auto"/>
                        </div>
                    </div>
                    <div v-else class="pl-12 relative response-block scroll-mt-32 min-h-[60px]" v-show="message">
                        <div class="absolute top-0 left-0">
                            <img src="https://image.gstatics.cn/icon/geekchat.png" class="w-9 h-9 rounded-md flex-none">
                            <div class="my-1 flex items-center justify-center">
                                <button>
                                    <svg stroke="currentColor"
                                         fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true"
                                         class="w-4 h-4 hover:text-black transition-all text-gray-400" height="1em"
                                         width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="w-full">
                            <markdown :source="message.content" class="prose prose-sm "/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-4 text-center w-full space-x-2" v-if="messages.length > 0 && !isTyping">
                <button @click="regenerate" v-if="lastAction && lastMessage"
                        class="inline-flex items-center justify-center rounded-full px-3 py-2 shadow-md bg-blue-400 text-white hover:bg-blue-500 transition-all active:bg-blue-600 group font-semibold text-xs">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                         aria-hidden="true"
                         class="w-4 h-4 mr-1 group-hover:rotate-180 transition-all" height="1em" width="1em"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span>重新生成</span>
                </button>
                <button @click="reset"
                        class="inline-flex items-center justify-center rounded-full px-3 py-2 text-sm shadow-md bg-gray-400 hover:bg-gray-500 text-white transition-all active:bg-gray-600 group font-semibold text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         aria-hidden="true" stroke="currentColor"
                         class="w-4 h-4 mr-1 group-hover:rotate-180 transition-all"
                         height="1em" width="1em">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                    <span>清空消息</span>
                </button>
            </div>
        </div>
        <div class="sticky bottom-0 left-0 right-0">
            <div class="max-w-5xl mx-auto w-full">
                <hr>
                <div class="p-4 bg-white px-4">
                    <div class="pb-safe">
                        <form class="grid grid-cols-1 gap-2  mb-2"
                              @submit.prevent="chat">
                            <textarea required id="chat-input-textbox" cols=""
                                      placeholder="输入你的问题/翻译内容/图片描述..." name="prompt"
                                      autocomplete="off" v-model="form.prompt"
                                      :style="{ height: (form.prompt && form.prompt.split('\n').length > 1) ? form.prompt.split('\n').length * 2 + 'rem' : '40px' }"
                                      class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:py-1.5 sm:text-sm sm:leading-6 resize-none"></textarea>
                            <div class="flex space-x-2 justify-end">
                                <button
                                    :class="{ 'flex items-center justify-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm md:text-base': true, 'opacity-25': isTyping }"
                                    title="发送消息" type="submit" :disabled="isTyping">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                                    </svg>
                                </button>
                                <!--                                <audio-widget @audio-upload="audio" @audio-failed="audioFailed" :is-typing="isTyping" />-->
                                <button
                                    :class="{ 'flex items-center justify-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm md:text-base': true, 'opacity-25': isTyping }"
                                    @click="translate" title="中英互译" type="button" :disabled="isTyping">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="none">
                                            <path d="M0 0h24v24H0z"></path>
                                            <path fill="#FFFFFF"
                                                  d="M17 10.5a1.5 1.5 0 0 1 1.493 1.356L18.5 12v.5h1a2 2 0 0 1 1.995 1.85l.005.15v3a2 2 0 0 1-1.85 1.995l-.15.005h-1v.5a1.5 1.5 0 0 1-2.993.144L15.5 20v-.5h-1a2 2 0 0 1-1.995-1.85l-.005-.15v-3a2 2 0 0 1 1.85-1.995l.15-.005h1V12a1.5 1.5 0 0 1 1.5-1.5Zm-12 4A1.5 1.5 0 0 1 6.5 16v1a.5.5 0 0 0 .5.5h3a1.5 1.5 0 0 1 0 3H7A3.5 3.5 0 0 1 3.5 17v-1A1.5 1.5 0 0 1 5 14.5Zm10.5.5h-1v2h1v-2Zm4 0h-1v2h1v-2ZM9.5 2.5a1.5 1.5 0 0 1 0 3h-4v1H9a1.5 1.5 0 1 1 0 3H5.5v1H10a1.5 1.5 0 0 1 0 3H4.1a1.6 1.6 0 0 1-1.6-1.6V4.1a1.6 1.6 0 0 1 1.6-1.6h5.4Zm7.5 1A3.5 3.5 0 0 1 20.5 7v2a1.5 1.5 0 0 1-3 0V7a.5.5 0 0 0-.5-.5h-3a1.5 1.5 0 0 1 0-3h3Z">
                                            </path>
                                        </g>
                                    </svg>
                                </button>
                                <button
                                    :class="{ 'flex items-center justify-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm md:text-base': true, 'opacity-25': isTyping }"
                                    @click="image" title="AI绘图" type="button" :disabled="isTyping">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="#FFFFFF"
                                              d="M4 2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4l-4 4l-4-4H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2m15 13V7l-4 4l-2-2l-6 6h12M7 5a2 2 0 0 0-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2Z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <section class="container mx-auto">
            <div class="text-center font-bold sm:text-3xl my-2 sm:my-5 text-red-600">
                坚持不易，请勿浪费！
            </div>
            <div class="grid grid-cols-1">
                <div class="py-2">
                    <h1 class="text-center md:text-4xl text-2xl px-4">获取属于你的私人API Key</h1>

                    <h3 class="text-center text-gray-400 pb-4 ">独立通道，数据安全</h3>

                    <span class="block text-center text-2xl my-2">
                        <a class="bg-blue-400 rounded-md  text-white px-4 py-2 hover:bg-blue-800"
                           href="https://faka.mianshijun.com" target="_blank">点击这里</a>
                    </span>
                </div>
            </div>
            <div class="w-1/2 py-2 mx-auto">
                <h1 class="text-center text-4xl font-bold pb-2">加社群防失联</h1>
                <span class="block text-sm text-center text-red-600">如果你有需要，请先加群，群满在加群主</span>
                <div class="flex space-x-2 mt-4 justify-center items-center">
                    <div class="border rounded-md text-center shadow-md overflow-hidden">
                        <img class="w-48 h-48 " src="images/wechat_group.jpg" alt="">
                    </div>
                    <div class=" border rounded-md text-center shadow-md overflow-hidden">
                        <img class="w-48  h-48" src="images/wechat_code.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="py-4">
                    <h1 class="text-center md:text-4xl text-2xl px-4">输入 API Key 查询使用额度</h1>

                    <form @submit.prevent="getAmount" class="flex space-x-2 items-center justify-center mt-4 pb-4 ">
                        <input type="text" name="amountKey" v-model="amount.amountKye" required
                               class="border rounded-md w-1/2" placeholder="请输入你的API Key">
                        <button class="block bg-blue-500 rounded-md py-2 px-4 hover:bg-blue-800 hover:text-white"
                                title="查询余额" type="submit" :disabled="isTyping">查询
                        </button>
                    </form>

                    <div class="pt-2 px-2 border w-1/2 mx-auto rounded-md bg-gray-100" v-show="isAmount">

                        <div class="flex justify-start py-1">总额：<span
                            class="text-gray-600 px-2">${{ totalGranted }}</span>
                        </div>
                        <div class="flex justify-start py-1">已用：<span
                            class="text-gray-600 px-2">${{ totalUsed }}</span>
                        </div>
                        <div class=" flex justify-start py-1">剩余：<span
                            class="text-gray-600 px-2">${{ totalAvailable }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden md:block w-1/2 py-2 mx-auto">
                <h1 class="text-center text-4xl font-bold pb-2">感谢赞助</h1>
                <span class="block text-sm text-center text-gray-400">坚持不易，感谢支持</span>
                <div class="flex space-x-2 mt-4 justify-center items-center">
                    <div class="w-48 h-48 border rounded-md shadow-md overflow-hidden">
                        <img src="images/wechat_pay_code.png" alt="">
                    </div>
                    <div class="w-48  h-48 border rounded-md shadow-md overflow-hidden">
                        <img src="images/alipay_code.png" alt="">
                    </div>
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
                    <a href="https://translator.lance.moe" target="_blank" class="block">
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
                    <a href="https://www.zeeno.ai" target="_blank" class="block">
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
                    <a href="https://github.com/zhayujie/chatgpt-on-wechat" target="_blank" class="block">
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
                    <a href="https://github.com/yihong0618/xiaogpt" target="_blank" class="block">
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
                    <a href="https://fsys.app/" target="_blank" class="block">
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
                    <a href="https://adorable-antimony-856.notion.site/ChatGPT-8ce48bcb5aa94828a64c86a2dbfc307d"
                       target="_blank" class="block">
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
                    <a href="https://b.jimmylv.cn/" target="_blank" class="block">
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


            <!-- Main modal -->
            <div v-show="isNotice"
                 class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto bg-gray-700 bg-opacity-50 min-h-screen md:inset-0 justify-center items-center flex">
                <div class="relative w-full h-full max-w-2xl md:h-auto mx-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-center p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-2xl font-bold text-red-600 dark:text-white">
                                公告
                            </h3>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6  border-b border-gray-200">
                            <p class="text-base leading-relaxed text-red-600">
                                <span class="font-bold">紧急通知</span>：从30号开始官方现在大面积处理账号，好多服务已经不能用，现在正在找其他解决方案，又需要的同学可以先加入社群，方便即使得到通知！
                            </p>
                            <div class=" flex justify-center  overflow-hidden">
                                <img class="w-56 h-56 " src="images/wechat_group.jpg" alt="">
                            </div>
                        </div>
                        <!-- Modal header -->
                        <div class="flex items-center justify-center p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-2xl font-bold text-red-600 dark:text-white">
                                特别说明
                            </h3>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6  border-b border-gray-200">
<!--                            <p class="text-base leading-relaxed text-gray-700 dark:text-gray-600">-->
<!--                                1.在使用过程中出现“<b>请求频率太高，请稍后再试</b>”，属于正常现象，毕竟本网站是属于<b>免费</b>使用，做了聊天频率限制，也可能没有<b>聊天额度</b>了,如果你有条件可以购买自己的API Key 使用，<b>专项通道，无频率限制</b>，<a-->
<!--                                href="https://faka.mianshijun.com" class="underline hover:text-blue-600 text-red-600" target="_blank">点击这里购买</a>-->
<!--                            </p>-->
                            <p class="text-base leading-relaxed text-gray-700 dark:text-gray-600">
                                本站坚持<b>免费提供</b>服务，实属不易，对于你们是免费的，对于我而是收费的，请大家<b>认真对待，避免浪费</b>，费用计算：<a
                                href="https://chat.wobcw.com/shares/2"  class="underline hover:text-blue-600 text-red-600"  target="_blank">点击这里</a>
                            </p>
                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex justify-end items-center p-6 space-x-2 rounded-b dark:border-gray-600">
                            <button @click="getNotice" type="button"
                                    class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                我已了解
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


</template>
<script>
import NavLink from '../Components/NavLink.vue'

export default {
    components: {
        NavLink
    }
}
</script>
