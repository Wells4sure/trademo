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

Vue.component('home', require('./components/LoginForm.vue').default);


const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi', // default - only for display purposes
          },
      }),
});
