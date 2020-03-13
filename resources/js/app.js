require('./bootstrap');

import 'es6-promise/auto'
import axios from 'axios'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import auth from './auth'
import router from './router'
import movie_card from './components/movie-card';
import VueElementLoading from 'vue-element-loading'

// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `http://localhost:9090/api/v1`
Vue.use(VueAuth, auth)

// Load Index
Vue.component('index', Index)
Vue.component('movie-card', movie_card);
Vue.component('VueElementLoading', VueElementLoading);
window.apiKey = '531eaffcac14a8c431f91d7a77a345e8';
const app = new Vue({
  el: '#app',
  router
})