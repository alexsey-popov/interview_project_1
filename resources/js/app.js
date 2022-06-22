/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'

Vue.use(VueRouter)

import AppComponent from './components/AppComponent'
import Equipment from './components/equipment/EquipmentComponent'
import EquipmentAdd from './components/equipment/EquipmentAddComponent'
import EquipmentShow from './components/equipment/EquipmentShowComponent'
import EquipmentEdit from './components/equipment/EquipmentEditComponent'
import EquipmentTypes from './components/equipmentTypes/EquipmentTypesComponent'
import Login from './components/auth/LoginComponent'
import Register from './components/auth/RegisterComponent'


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/equipment',
            name: 'equipment',
            component: Equipment
        },
        {
            path: '/equipment/add',
            name: 'equipment-add',
            component: EquipmentAdd,
        },
        {
            path: '/equipment/:equipmentId',
            name: 'equipment-show',
            component: EquipmentShow,
            props: true,
        },
        {
            path: '/equipment/:equipmentId/edit',
            name: 'equipment-edit',
            component: EquipmentEdit,
            props: true,
        },
        {
            path: '/equipment-type',
            name: 'equipmentTypes',
            component: EquipmentTypes
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
    ],
    linkActiveClass: "active",
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('app-component', require('./components/AppComponent.vue').default);
Vue.component('error', require('./components/templates/Error.vue').default);
Vue.component('spiner', require('./components/templates/Spiner.vue').default);


// const router = new VueRouter({mode: 'history', routes: routes});
    //  new Vue(
    //    Vue.util.extend(
    //    { router },
    //    App
    //   )).$mount('#app');

// Базовая проверка авторизации
Vue.prototype.isAuth = function () {
    return localStorage.hasOwnProperty('token');
};
// Очистка токена аутентификации
Vue.prototype.clearToken = function () {
    localStorage.removeItem( 'token' );
    localStorage.removeItem( 'user' );
    return true;
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  comments: {AppComponent},
  router,
});
