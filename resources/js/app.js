require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex'
import VueRouter from 'vue-router';
import router from './routes';
import Index from './Index';
import Alert from './shared/components/Alert';
import Loading from './shared/components/Loading';

import storeObject from './shared/store/storeObject';
import authMiddleware from './shared/middleware/authMiddleware';

window.Vue = require('vue').default;

Vue.use(VueRouter);
Vue.use(Vuex)

Vue.component('alert', Alert);
Vue.component('loading', Loading);

const store = new Vuex.Store(storeObject);

window.axios.interceptors.response.use(
	response => {
		return response;
	},
	error => {
		if(error.response.status === 401) {
			store.dispatch(logout);
		}

		return Promise.reject(error);
	}
);

router.beforeEach(authMiddleware);

const app = new Vue({
	el: '#app',
	router,
  store,
	components: {
		'index': Index,
	},
	async beforeCreate() {
		this.$store.dispatch('loadUser');
	}
});
