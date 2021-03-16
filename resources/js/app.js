/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from "vue-router";
import CreateJob from './components/CreateJob';
import IndexJob from "./components/IndexJob";
import Article from "./components/Article";
import Notfound from "./components/Notfound.vue";
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
        {
            path: '/404',
            component: Notfound
        }


    ]
})

const main = new Vue({
    el: '#app',
    components: {
        App
    },
    router
});
