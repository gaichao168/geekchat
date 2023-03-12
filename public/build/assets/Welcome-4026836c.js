import{v as C,C as A,x as B,o,f as r,a as m,u as c,X as G,b as e,F as u,y as L,n as h,t as p,g as _,i as F,z as V,e as j,d as g,D as x,O as D}from"./app-0a82b4b5.js";import{A as S}from"./AudioWidget-9614e54f.js";import"./_plugin-vue_export-helper-c27b6911.js";const T={class:"flex flex-col space-y-4 p-4"},M={class:"ml-4"},N={class:"text-lg"},z={key:0,href:"#",class:"font-medium text-gray-900"},q={key:1,href:"#",class:"font-medium text-gray-900"},O={class:"mt-1"},P={class:"text-gray-600"},U=e("div",{id:"msg-anchor"},null,-1),W={key:0,class:"flex rounded-lg p-4 bg-green-200 flex-reverse'"},E={class:"ml-4"},H={class:"mt-1"},I={class:"text-gray-500"},R={key:1,class:"flex rounded-lg p-4 bg-red-400 flex-reverse'"},X={class:"ml-4"},J={class:"mt-1"},K={class:"text-gray-100"},Q=["onSubmit"],Y={class:"relative w-full"},Z=["disabled"],$=e("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"})],-1),ee=[$],te=e("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"})],-1),se=[te],oe=e("footer",{class:"text-center sm:text-left"},[e("div",{class:"p-4 text-center text-neutral-700"},[g(" GeekChat 是一个小而美的免费体验版 ChatGPT，由 "),e("a",{href:"https://geekr.dev",target:"_blank",class:"text-neutral-800 dark:text-neutral-400"},"极客书房"),g(" 开发，支持文字语音聊天咨询。 ")])],-1),le={__name:"Welcome",props:{canLogin:Boolean,canRegister:Boolean,messages:Array},setup(f){const a=C({prompt:""}),t=A({error:"",toast:""}),v=()=>{a.post(route("chat"),{onStart:()=>{t.error="",a.reset(),t.toast="GeekChat正在思考如何回答您的问题，请稍候..."},onFinish:s=>{s.status>=400&&(s.status==429?t.error="请求过于频繁，请稍后再试":t.error="请求处理失败，请重试"),t.toast="",d()}})},k=()=>{x.get(route("reset")).then(s=>{D.reload()})},d=()=>{document.querySelector("#msg-anchor").scrollIntoView({behavior:"smooth"})},y=s=>{const n=new FormData;n.append("audio",s),t.error="",t.toast="GeekChat正在识别语音并思考如何回答您的问题，请稍候...",x.post(route("audio"),n).then(i=>{t.toast="",location.reload(),d()}).catch(i=>{t.toast="",i.includes("429")?t.error="请求过于频繁，请稍后再试":t.error="处理语音失败，可能没录音成功（按下话筒图标->开始讲话->讲完按下终止图标，操作不要太快），再来一次试试吧",d()})},w=s=>{t.error=s,t.toast=""};return(s,n)=>{const i=B("markdown");return o(),r(u,null,[m(c(G),{title:"GeekChat - ChatGPT免费体验版"}),e("div",T,[(o(!0),r(u,null,L(f.messages,(l,b)=>(o(),r("div",{key:b,class:h([l.role=="assistant"?"flex rounded-lg p-4 bg-green-200 flex-reverse":"flex rounded-lg p-4 bg-blue-200"])},[e("div",M,[e("div",N,[l.role=="assistant"?(o(),r("a",z,"GeekChat")):(o(),r("a",q,"你"))]),e("div",O,[e("p",P,[m(i,{source:l.content},null,8,["source"])])])])],2))),128)),U,t.toast?(o(),r("div",W,[e("div",E,[e("div",H,[e("p",I,p(t.toast),1)])])])):_("",!0),t.error?(o(),r("div",R,[e("div",X,[e("div",J,[e("p",K,p(t.error),1)])])])):_("",!0)]),e("form",{class:"p-4 flex space-x-4 justify-center items-center",onSubmit:j(v,["prevent"])},[e("div",Y,[F(e("input",{id:"message",placeholder:"输入你的问题...",type:"text",name:"prompt",autocomplete:"off","onUpdate:modelValue":n[0]||(n[0]=l=>c(a).prompt=l),class:"w-full first-letter:border rounded-md p-2 flex-1",required:""},null,512),[[V,c(a).prompt]]),m(S,{onAudioUpload:y,onAudioFailed:w})]),e("button",{class:h({"flex items-center justify-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md text-sm md:text-base":!0,"opacity-25":c(a).processing}),disabled:c(a).processing,type:"submit"},ee,10,Z),e("button",{class:"flex items-center justify-center px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded-md text-sm md:text-base",onClick:k},se)],40,Q),oe],64)}}};export{le as default};
