/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
import Vue from 'vue'

window.EventBus = new Vue();
import AdminIndex from './components/admin/IndexComponent/AdminIndex';

new Vue({
    render: h => h(AdminIndex),
}).$mount("#admin-index");
