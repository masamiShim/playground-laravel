/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

// Vue
import Vue from 'vue'
import Vuetify from "vuetify";
import colors from "vuetify/es5/util/colors"
import 'vuetify/dist/vuetify.min.css'
import router from './router'
import { store } from './store/index'
import DatetimePicker from 'vuetify-datetime-picker'
import Toasted from 'vue-toasted'
import dayjs from "dayjs";
import 'dayjs/locale/ja';
import http from "./api/CustomAxios";

//Vuetify

Vue.use(Vuetify, {
   theme: {
       primary: colors.indigo.base,
       secondary: colors.blue.base,
       accent: colors.amber.base,
   }
});

var toast_options = {
    position: 'top-center',
    duration: 2000,
    fullWidth: true,
    fitToScreen: true,
}
Vue.use(DatetimePicker);
Vue.use(Toasted, toast_options);

window.$http = http;
window.axios = axios;
Vue.prototype.$cookies = require('js-cookie');

dayjs.locale('ja');
Vue.prototype.$dj = dayjs;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app', require('./components/App.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    store,
    vuetify: new Vuetify({}),
}).$mount('#app');
