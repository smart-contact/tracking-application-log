require('./bootstrap');
import Vue from 'vue';
import Routes from './routes';
import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(VueRouter)
Vue.use(ElementUI);

const router = new VueRouter({
    routes: Routes,
    mode: 'hash',
    base: '/',
});

var app = new Vue({
    el: '#tracking-application-log',
    router,
    data: {
      message: 'Hello Vue!'
    }
  })