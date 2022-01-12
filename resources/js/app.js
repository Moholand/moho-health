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
	components: {
		'index': Index,
	}
});
