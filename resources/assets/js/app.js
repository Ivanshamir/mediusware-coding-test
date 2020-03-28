
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
import moment from 'moment';

Vue.component('history', require('./components/History.vue'));

Vue.component('pagination', require('./components/Pagination.vue'));
Vue.filter('formatDate', function (created) {
    return moment(created).format('Do MMM YYYY h:mm a')
});
Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
});
const app = new Vue({
    el: '#history'
});