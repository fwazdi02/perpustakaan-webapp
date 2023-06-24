import Vue from 'vue'
import VueRouter from 'vue-router';
import { routes } from './routes';
import App from './App.vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.use(VueRouter);

Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

new Vue({
  el: '#app',
  render: (h) => h(App),
  router
});