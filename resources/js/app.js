import Vue from 'vue';
import ElementUI from 'element-ui';
import App from '@/views/App';
import store from '@/store';
import router from '@/router';
import i18n from '@/lang'; // Internationalization
import '@/icons'; // icon
import vueNumeralFilterInstaller from 'vue-numeral-filter';
import VueAWN from "vue-awesome-notifications";
console.log(111111,3333333333,router);

import * as filters from './filters'; // global filters

Vue.use(ElementUI, {
    i18n: (key, value) => i18n.t(key, value),
});
Vue.use(vueNumeralFilterInstaller);

Vue.use(VueAWN, {position: 'top-right'});

// register global utility filters.
Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key]);
});

Vue.config.productionTip = false;

new Vue({
    el: '#app',
    router,
    store,
    i18n,
    render: h => h(App),
});
