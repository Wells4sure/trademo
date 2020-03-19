require('./bootstrap');

window.Vue = require('vue');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import Vuelidate from 'vuelidate';

Vue.use(Vuelidate);
Vue.use(Vuetify);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.component('login', require('./components/LoginForm.vue').default);
Vue.component('install', require('./components/Install.vue').default);
Vue.component('home', require('./components/Home.vue').default);
Vue.component('footer-comp', require('./components/includes/Footer.vue').default);
Vue.component('navbar-comp', require('./components/includes/Navigation.vue').default);


const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi', // default - only for display purposes
          },
          theme: {
            dark: true,
          },
      }),
});
