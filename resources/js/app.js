require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex'
import VueRouter from 'vue-router';
import router from './routes';
import Index from './Index';
import Alert from './shared/components/Alert';
import Loading from './shared/components/Loading';

window.Vue = require('vue').default;

Vue.use(VueRouter);
Vue.use(Vuex)

Vue.component('alert', Alert);
Vue.component('loading', Loading);

const store = new Vuex.Store({
  state: {
    currentUser: null
  },
  mutations: {
    setCurrentUser(state, payload) {
      state.currentUser = payload;
    }
  }
})

function loggedIn() {
	return localStorage.getItem('token');
}

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!loggedIn()) {
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else if(to.matched.some(record => record.meta.guest)) {
    if (loggedIn()) {
      next({
        path: '/',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else {
		next() // make sure to always call next()!;
	}
});

const app = new Vue({
	el: '#app',
	router,
  store,
	components: {
		'index': Index,
	}
});
