
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//Vrsi se registrovanje komponenti
Vue.component('google-map', require('./components/googlemap.vue'));
Vue.component('comments', require('./components/comments.vue'));
Vue.component('event-map', require('./components/eventmap.vue'));
Vue.component('friendbutton', require('./components/friendbutton.vue'));
Vue.component('star-rating', require('./components/star-rating.vue'));
Vue.component('like-rating', require('./components/like-rating.vue'));
Vue.component('notification', require('./components/notification.vue'));
Vue.component('request', require('./components/request.vue'));
Vue.component('admin-map', require('./components/adminmap.vue'));
Vue.component('friend-list', require('./components/friendlist.vue'));
Vue.component('event-select', require('./components/eventselect.vue'));
Vue.component('countdown-timer', require('./components/countdowntimer.vue'));

const app = new Vue({
    el: '#app'
});
