
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import CustomersIndex from './components/customers/CustomersIndex.vue';
import CustomersCreate from './components/customers/CustomersCreate.vue';
import CustomersEdit from './components/customers/CustomersEdit.vue';

const routes = [
    {
        path: '/admin/customers',
        components: {
            companiesIndex: CustomersIndex
        }
    },
    {
        path: '/admin/customers/create',
        component: CustomersCreate,
        name: 'createCompany'
    },
    {
        path: '/admin/customers/edit/:id',
        component: CustomersEdit,
        name: 'editCompany'
    },
];

const router = new VueRouter({ routes });

const app = new Vue({ router }).$mount('#app');