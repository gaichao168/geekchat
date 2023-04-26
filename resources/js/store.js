// store.js
import {createStore} from 'vuex';
import ChatAPI from './api/chat';

const store = createStore({
    state() {
        return {
            messages: [],
            apiKey: '',
            isTyping: false,
            lastAction: '',
            lastMessage: '',
            totalAvailable: 0.00,
            totalGranted: 0.00,
            totalUsed: 0.00,
            isAmount: false,
            isNotice: false,
            officialAccount: {
                isModal: false,
                isValidErr: false,
                code: '',
            },
        }
    },
    mutations: {
        initMessages(state, messages) {
            state.messages = messages;
        },
        addMessage(state, message) {
            state.messages.push(message)
        },
        deleteMessage(state) {
            state.messages.pop()
        },
        clearMessages(state) {
            state.messages = []
        },
        toggleTyping(state) {
            state.isTyping = !state.isTyping
        },
        setApiKey(state, apiKey) {
            state.apiKey = apiKey;
        },
        setLastLog(state, {action, message}) {
            state.lastAction = action;
            state.lastMessage = message;
        },
        setAmount(state, {totalGranted, totalUsed, totalAvailable}) {
            state.totalGranted = totalGranted;
            state.totalAvailable = totalAvailable;
            state.totalUsed = totalUsed;
            state.isAmount = true;
        },
        setNotice(state, isNotice) {
            state.isNotice = isNotice;
        },
        setOfficialAccountModal(state, {isModal, isValidErr = false, code = ''}) {
            state.officialAccount.isModal = isModal;
            state.officialAccount.isValidErr = isValidErr;
            state.officialAccount.code = code;
        }
    },
    actions: {
        // 初始化消息
        initMessages({commit}) {
            commit('setApiKey', window.localStorage.getItem('GEEKCHAT_API_KEY', ''));
            commit('setLastLog', {
                action: window.localStorage.getItem('GEEKCHAT_LAST_ACTION', ''),
                message: window.localStorage.getItem('GEEKCHAT_LAST_MESSAGE', '')
            });
            ChatAPI.getMessages().then(response => {
                commit('initMessages', response.data);
            }).catch(error => {
                commit('initMessages', []);
            });
            // const isNotice = Boolean(window.localStorage.getItem("IS_NOTICE")) !== true
            commit('setNotice', true)
        },
        chatMessage({state, commit}, {message, regen = false}) {
            commit('toggleTyping')
            console.log(regen)
            if (!regen) {
                // 第一次才输出用户消息并记录日志
                commit('addMessage', {'role': 'user', 'content': message})
                window.localStorage.setItem('GEEKCHAT_LAST_ACTION', 'chat');
                window.localStorage.setItem('GEEKCHAT_LAST_MESSAGE', message);
                commit('setLastLog', {action: 'chat', message: message});
            } else if (state.messages[state.messages.length - 1].role === 'assistant') {
                // 跟服务端逻辑一致，先把最后一条回复删掉
                commit('deleteMessage');
            }
            ChatAPI.chatMessage(message, regen).then(response => {
                if (response.status === 401){
                    commit('addMessage', {'role': 'assistant', 'content': '请规范你的言行,谢谢！'})
                    throw new Error('请规范你的言行,谢谢！');
                }else if (response.status === 429) {
                    commit('addMessage', {'role': 'assistant', 'content': '哎呀！次数用尽啦，加入社群，找群主解决吧！'})
                    throw new Error('哎呀！次数用尽啦，加入社群，找群主解决吧！');  // 抛出异常，中断后续操作
                } else if (response.status >= 400) {
                    commit('addMessage', {'role': 'assistant', 'content': '出错了！不用怕，加入社群，让群主搞定它！'})
                    throw new Error('出错了！不用怕，加入社群，让群主搞定它！');
                }
                return response.json();
            }).then(data => {
                commit('setOfficialAccountModal', {
                    isModal: data.isModal,
                    code: data.code,
                })
                commit('addMessage', {'role': 'assistant', 'content': '正在思考如何回答您的问题，请稍候...'})
                const apiKey = state.apiKey ? btoa(state.apiKey) : '';
                const eventSource = new EventSource(`/stream?chat_id=${data.chat_id}&api_key=${apiKey}`);
                eventSource.onmessage = function (e) {
                    if (state.messages[state.messages.length - 1].content === '正在思考如何回答您的问题，请稍候...') {
                        state.messages[state.messages.length - 1].content = '';
                    }
                    if (e.data == "[DONE]") {
                        eventSource.close();
                        commit('toggleTyping')
                    } else {
                        let word = JSON.parse(e.data).choices[0].delta.content
                        if (word !== undefined) {
                            state.messages[state.messages.length - 1].content += JSON.parse(e.data).choices[0].delta.content
                        }
                    }
                };
                eventSource.onerror = function (e) {
                    eventSource.close();
                    commit('deleteMessage');
                    const error = state.apiKey ? '请求失败，请确保你使用的是有效的API KEY' : '出错了！不用怕，加入社群，让群主搞定它！'
                    commit('addMessage', {'role': 'assistant', 'content': error})
                    commit('toggleTyping')
                };
            }).catch(error => {
                console.log(error);
                if (state.isTyping) {
                    commit('toggleTyping')
                }
            });
        },
        translateMessage({state, commit}, {message, regen = false}) {
            commit('toggleTyping')
            if (!regen) {
                commit('addMessage', {'role': 'user', 'content': message})
                window.localStorage.setItem('GEEKCHAT_LAST_ACTION', 'translate');
                window.localStorage.setItem('GEEKCHAT_LAST_MESSAGE', message);
                commit('setLastLog', {action: 'translate', message: message});
            } else if (state.messages[state.messages.length - 1].role === 'assistant') {
                commit('deleteMessage');
            }
            ChatAPI.translateMessage(message, regen).then(response => {
                if (response.status === 401){
                    commit('addMessage', {'role': 'assistant', 'content': '请规范你的言行,谢谢！'})
                    throw new Error('请规范你的言行,谢谢！');
                }else if (response.status === 429) {
                    commit('addMessage', {'role': 'assistant', 'content': '哎呀！次数用尽啦，加入社群，找群主解决吧！'})
                    throw new Error('哎呀！次数用尽啦，加入社群，找群主解决吧！');  // 抛出异常，中断后续操作
                } else if (response.status >= 400) {
                    commit('addMessage', {'role': 'assistant', 'content': '出错了！不用怕，加入社群，让群主搞定它！'})
                    throw new Error('出错了！不用怕，加入社群，让群主搞定它！');
                }
                return response.json();
            }).then(data => {
                commit('addMessage', {'role': 'assistant', 'content': '正在自动翻译你提交的内容，请稍候...'})
                const apiKey = state.apiKey ? btoa(state.apiKey) : '';
                const eventSource = new EventSource(`/stream?chat_id=${data.chat_id}&api_key=${apiKey}`);
                eventSource.onmessage = function (e) {
                    if (state.messages[state.messages.length - 1].content === '正在自动翻译你提交的内容，请稍候...') {
                        state.messages[state.messages.length - 1].content = '';
                    }
                    if (e.data == "[DONE]") {
                        eventSource.close();
                        commit('toggleTyping')
                    } else {
                        let word = JSON.parse(e.data).choices[0].delta.content
                        if (word !== undefined) {
                            state.messages[state.messages.length - 1].content += JSON.parse(e.data).choices[0].delta.content
                        }
                    }
                };
                eventSource.onerror = function (e) {
                    eventSource.close();
                    commit('deleteMessage');
                    const error = state.apiKey ? '请求失败，请确保你使用的是有效的API KEY' : '出错了！不用怕，加入社群，让群主搞定它！'
                    commit('addMessage', {'role': 'assistant', 'content': error})
                    commit('toggleTyping')
                };
            }).catch(error => {
                console.log(error);
                if (state.isTyping) {
                    commit('toggleTyping')
                }
            });
        },
        audioMessage({state, commit}, blob) {
            commit('toggleTyping')
            commit('addMessage', {'role': 'user', 'content': '正在识别语音，请稍候...'})
            ChatAPI.audioMessage(blob).then(response => {
                commit('deleteMessage');
                if (response.status === 429) {
                    commit('addMessage', {'role': 'assistant', 'content': '哎呀！次数用尽啦，加入社群，找群主解决吧！'})
                    throw new Error('哎呀！次数用尽啦，加入社群，找群主解决吧！');  // 抛出异常，中断后续操作
                } else if (response.status >= 400) {
                    commit('addMessage', {'role': 'assistant', 'content': '出错了！不用怕，加入社群，让群主搞定它！'})
                    throw new Error('出错了！不用怕，加入社群，让群主搞定它！');
                }
                return response.json();
            }).then(data => {
                commit('addMessage', data.message); // 将语音识别结果作为用户文本信息
                window.localStorage.setItem('GEEKCHAT_LAST_ACTION', 'audio');
                window.localStorage.setItem('GEEKCHAT_LAST_MESSAGE', data.message.content);
                commit('setLastLog', {action: 'audio', message: data.message.content});
                if (data.message.role === 'assistant') {
                    throw new Error('语音识别失败，请重试');
                }
                commit('addMessage', {'role': 'assistant', 'content': '正在思考如何回答您的问题，请稍候...'})
                const apiKey = state.apiKey ? btoa(state.apiKey) : '';
                const eventSource = new EventSource(`/stream?chat_id=${data.chat_id}&api_key=${apiKey}`);
                eventSource.onmessage = function (e) {
                    if (state.messages[state.messages.length - 1].content === '正在思考如何回答您的问题，请稍候...') {
                        state.messages[state.messages.length - 1].content = '';
                    }
                    if (e.data == "[DONE]") {
                        eventSource.close();
                        commit('toggleTyping')
                    } else {
                        let word = JSON.parse(e.data).choices[0].delta.content
                        if (word !== undefined) {
                            state.messages[state.messages.length - 1].content += JSON.parse(e.data).choices[0].delta.content
                        }
                    }
                };
                eventSource.onerror = function (e) {
                    eventSource.close();
                    commit('deleteMessage');
                    const error = state.apiKey ? '请求失败，请确保你使用的是有效的API KEY' : '出错了！不用怕，加入社群，让群主搞定它！'
                    commit('addMessage', {'role': 'assistant', 'content': error})
                    commit('toggleTyping')
                };
            }).catch(error => {
                if (state.messages[state.messages.length - 1].content === '正在识别语音，请稍候...') {
                    commit('deleteMessage');
                    commit('addMessage', {'role': 'assistant', 'content': '网络请求失败，请重试'})
                }
                console.log(error);
                if (state.isTyping) {
                    commit('toggleTyping')
                }
            });
        },
        imageMessage({state, commit}, {message, regen = false}) {
            commit('toggleTyping')
            if (!regen) {
                commit('addMessage', {'role': 'user', 'content': message})
                window.localStorage.setItem('GEEKCHAT_LAST_ACTION', 'image');
                window.localStorage.setItem('GEEKCHAT_LAST_MESSAGE', message);
                commit('setLastLog', {action: 'image', message: message});
            } else if (state.messages[state.messages.length - 1].role === 'assistant') {
                commit('deleteMessage');
            }
            commit('addMessage', {'role': 'assistant', 'content': '正在根据你提供的信息绘图，请稍候...'})
            ChatAPI.imageMessage(message, regen).then(response => {
                commit('deleteMessage')
                commit('addMessage', response.data);
                commit('toggleTyping')
            }).catch(error => {
                commit('deleteMessage')
                if (error.response.status === 401){
                    commit('addMessage', {'role': 'assistant', 'content': '请规范你的言行,谢谢！'})
                    throw new Error('请规范你的言行,谢谢！');
                }else if (error.response.status === 429) {
                    commit('addMessage', {'role': 'assistant', 'content': '哎呀！次数用尽啦，加入社群，找群主解决吧！'});
                } else {
                    commit('addMessage', {'role': 'assistant', 'content': '请求处理失败，请重试'});
                }
                commit('toggleTyping')
            });
        },
        validAndSetApiKey({commit}, apiKey) {
            if (apiKey === null || apiKey === undefined || apiKey === '') {
                // 设置为空则删除本地存储的apikey
                commit('setApiKey', apiKey);
                window.localStorage.removeItem('GEEKCHAT_API_KEY');
                return;
            }
            ChatAPI.validApiKey(apiKey).then(response => {
                if (response.data.valid != true) {
                    alert(response.data.error);
                    return;
                }
                commit('setApiKey', apiKey);
                window.localStorage.setItem('GEEKCHAT_API_KEY', apiKey);
            }).catch(error => {
                alert('网络请求失败，请刷新页面重试');
            });
        },
        clearMessages({commit}) {
            ChatAPI.clearMessages().then(response => {
                commit('clearMessages');
                window.localStorage.removeItem('GEEKCHAT_LAST_ACTION');
                window.localStorage.removeItem('GEEKCHAT_LAST_MESSAGE');
                window.localStorage.removeItem('IS_NOTICE');
                commit('setLastLog', {action: '', message: ''});
            }).catch(error => {
                console.log(error);
            });
        },
        getAmount({commit}, apiKey) {
            ChatAPI.getAmount(apiKey).then(response => {
                console.log(response.data)
                if (response.data.status != true) {
                    alert(response.data.error);
                    return;
                }
                commit('setAmount', {
                    totalGranted: response.data.total_granted,
                    totalAvailable: response.data.total_available,
                    totalUsed: response.data.total_used
                })
            }).catch(error => {
                alert('网络请求失败，请刷新页面重试');
            });
        },
        getNotice({commit}) {
            // window.localStorage.setItem("IS_NOTICE", false)
            commit('setNotice', false);
        },
        validCode({commit}) {
            ChatAPI.isValidOfficialAccount().then(response => {
                if (response.data.isValidRes === true) {
                    commit('setOfficialAccountModal', {
                        isModal: false,
                    })
                } else {
                    const code = store.state.officialAccount.code
                    commit('setOfficialAccountModal', {
                        isModal: true,
                        isValidErr: true,
                        code,
                    })
                }
            })
        }
    },
    getters: {
        // 获取所有消息
        allMessages(state) {
            return state.messages
        }
    },
})

export default store
