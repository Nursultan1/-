import { METHODS } from 'http';
import axios from 'axios';
import Vue from 'vue';

/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('admin-items', require('./components/admin-items.vue'));
Vue.component('admin-teache', require('./components/admin-teache.vue'));
Vue.component('admin-pupil', require('./components/admin-pupil.vue'));
Vue.component('example', require('./components/Example.vue'));
Vue.component('classes', require('./components/classes.vue'));
Vue.component('Journal', require('./components/Journal.vue'));
Vue.component('Home', require('./components/Home.vue'));


const app = new Vue({
    el: '#app',
    data:{
        test: "fvjkfdnvjkdfv"
    },
    methods:{
        hide: function() {
            console.log("dcdcd")
        },
    }
});
