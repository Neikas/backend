/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

window.Vue = require('vue').default;

import VueRouter from "vue-router";
import CreateJob from './components/CreateJob';
import IndexJob from "./components/IndexJob";
import Article from "./components/Article";
import { MdChips } from 'vue-material/dist/components';
import 'vue-material/dist/vue-material.min.css';
import 'vue-material/dist/theme/default.css';
const App = Vue.component('app', require('./App.vue').default);

Vue.use(VueRouter);
Vue.use(MdChips);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: IndexJob
        },
        {
            path: '/job/create',
            component: CreateJob
        },
        {
            path: '/articles/:id',
            component: Article,
            name:'article.show'
        },

    ]
})

const main = new Vue({
    el: '#app',
    components: {
        App
    },
    router
});
