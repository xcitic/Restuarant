
window.Vue = require('vue');

// Include and register components
Vue.component('nav-bar', require('./components/NavBar.vue').default);
Vue.component('section-top', require('./components/SectionTop.vue').default);
Vue.component('modal-reservation', require('./components/ModalReservation.vue').default);
Vue.component('modal-contact', require('./components/ModalContact.vue').default);
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

// Setup Axios and default headers
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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
