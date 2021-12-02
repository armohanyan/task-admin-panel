/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import axios from 'axios'
import Vue from 'vue'
window.EventBus = new Vue();
Vue.use(VueAxios, axios)
import VueAxios from 'vue-axios'
import App from './App';
import router  from './router/index'

new Vue({
    router,
    render: h => h(App),
}).$mount("#app");
