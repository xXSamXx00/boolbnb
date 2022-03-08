/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';

require('./bootstrap');


window.Vue = require('vue');


Vue.component('map-component', require('./components/MapComponent.vue').default);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('advanced-search', require('./components/AdvancedSearch.vue').default);
Vue.component('searchbarComponent', require('./components/SearchbarComponent.vue').default);


export const Bus = new Vue();

// import tt from '@tomtom-international/web-sdk-maps';
// import { services } from '@tomtom-international/web-sdk-services';
// import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

const app = new Vue({
    el: '#app',
    data: {

    },

    methods: {


        verifyPassword() {
            var password = document.getElementById("password")
                , confirm_password = document.getElementById("password-confirm");

            function validatePassword() {
                if (password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("La password non corrisponde");
                } else {
                    confirm_password.setCustomValidity('');
                }
            }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;

        }
    },

    mounted() {
        const registerButton = document.getElementById('register_button');
        if (registerButton) {
            registerButton.addEventListener('click', this.verifyPassword());
        }
    }
});
