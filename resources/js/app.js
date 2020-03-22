require('./bootstrap');

window.Vue = require('vue');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import Vuelidate from 'vuelidate';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import storeData from "./store/index";

Vue.use(Vuex)
Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(Vuetify);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(require('vue-moment'));

const store = new Vuex.Store(
  storeData
)


let routes = [
  // { path: '/home', component:  require('./components/Home.vue').default },
  // { path: '/pos', component:  require('./components/ts.vue').default },
 
];
const router = new VueRouter({
  mode:'history',
  routes // short for `routes: routes`
});

Vue.component('login', require('./components/LoginForm.vue').default);
Vue.component('install', require('./components/Install.vue').default);
Vue.component('footer-comp', require('./components/includes/Footer.vue').default);
Vue.component('navbar-comp', require('./components/includes/Navigation.vue').default);
Vue.component('home', require('./components/Home.vue').default);

Vue.component('categories', require('./components/Categories.vue').default);


const app = new Vue({
    el: '#app',
    store,
    router,
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi', // default - only for display purposes
          },
          theme: {
            dark: true,
          },
      }),
});
