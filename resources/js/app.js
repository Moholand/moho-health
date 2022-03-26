require('./bootstrap');

import Vue, { createApp } from 'vue';
import Vuex from 'vuex'
// import VueRouter from 'vue-router';
import router from './routes';
import Index from './Index';

import Alert from './shared/components/Alert';
import Loading from './shared/components/Loading';
import Confirm from './shared/components/Confirm';

import store from './shared/store';
import authMiddleware from './shared/middleware/authMiddleware';

window.Vue = require('vue').default;

// Vue.use(Vuex)

Vue.component('alert', Alert);
Vue.component('loading', Loading);
Vue.component('confirm', Confirm);

// const store = new Vuex.Store(storeObject);

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

createApp(Index)
	.use(store)
	.use(router)
	.mount('#app');
