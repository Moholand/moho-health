import VueRouter from 'vue-router';
import Home from './home/Home';
import About from './about/About';
import AdminSliders from './admin/sliders/AdminSliders';
import Register from './auth/Register';
import Login from './auth/Login';

const routes = [
  {
    path: "/",
    name: 'home',
    component: Home,
  }, 
  {
    path: "/register",
    name: 'register',
    component: Register,
    meta: { guest: true }
  },
  {
    path: "/login",
    name: 'login',
    component: Login,
    meta: { guest: true }
  },
  {
    path: "/about-us",
    name: 'about',
    component: About,
  },
  {
    path: "/admin/sliders",
    name: 'admin-sliders',
    component: AdminSliders,
    meta: { requiresAuth: true }
  },
];

const router = new VueRouter({
  routes, // short for 'routes: routes'
  mode: 'history',
});

export default router;