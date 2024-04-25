// import Vue from 'vue';
// import RichTextEditor from './components/RichTextEditor.vue';
//
// Vue.component('rich-text-editor', RichTextEditor);
//
// const app = new Vue({
//     el: '#app',
// });


//
// import Vue from 'vue';
// window.Vue = require('vue');
//
// window.Vue.component('rich-text-editor', RichTextEditor);
//
//
// new Vue({
//     el: '#app',
// });


// import { createApp } from 'vue';
//
// let app=createApp({})
// app.component('rich-text-editor', require('./components/RichTextEditor.vue').default);
// app.mount("#app")


import { createApp } from 'vue';
import RichTextEditor from './components/RichTextEditor.vue';

let main=createApp({})
main.component('rich-text-editor' , RichTextEditor);

main.mount("#tools-volcator")

