import Vue from 'vue';
// Import Plugins
import VueFlashMessage from 'vue-flash-message';
import VModal from 'vue-js-modal';
require('vue-flash-message/dist/vue-flash-message.min.css');
import VeeValidate from 'vee-validate';

// Bind plugins
Vue.use(VueFlashMessage, {
  messageOptions: {
    timeout: 3000
  }
});
Vue.use(VModal, { dynamic: true, dynamicDefaults: { clickToClose: false } });
Vue.use(VeeValidate);

// Include and register components
Vue.component('nav-bar', require('./components/NavBar.vue').default);
Vue.component('section-top', require('./components/SectionTop.vue').default);
Vue.component('modal-reservation', require('./components/ModalReservation.vue').default);
Vue.component('modal-contact', require('./components/ModalMessage.vue').default);
Vue.component('section-about', require('./components/SectionAbout.vue').default);
Vue.component('section-streak', require('./components/SectionStreak.vue').default);
Vue.component('section-menu', require('./components/SectionMenu.vue').default);
Vue.component('section-products', require('./components/SectionProducts.vue').default);
Vue.component('section-menu-table', require('./components/SectionMenuTable.vue').default);
Vue.component('section-streak-2', require('./components/SectionStreak2.vue').default);
Vue.component('section-pictures', require('./components/SectionPictures.vue').default);
Vue.component('section-reviews', require('./components/SectionReviews.vue').default);
Vue.component('section-footer', require('./components/SectionFooter.vue').default);
// Vue.component('scroll-to-top', require('./components/ScrollToTop.vue').default);
Vue.component('section-dashboard-list', require('./components/DashboardList.vue').default);
Vue.component('nav-bar-dash', require('./components/NavBarDash.vue').default);

// Setup Axios and default headers
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = process.env.MIX_APP_URL;

// CSRF Token for laravel requests
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}




// Create the vue instance and mount it to #vuejs div.
const app = new Vue({
    el: '#vuejs',
});
