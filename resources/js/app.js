require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './routes';
import Index from './Index';
import Alert from './shared/components/Alert';
import Loading from './shared/components/Loading';

window.Vue = require('vue').default;

Vue.use(VueRouter);

Vue.component('alert', Alert);
Vue.component('loading', Loading);

const app = new Vue({
	el: '#app',
	router,
	components: {
		'index': Index,
	}
});
