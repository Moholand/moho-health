import VueRouter from 'vue-router';
import Home from './home/Home';
import About from './about/About';
import AdminSliders from './admin/sliders/AdminSliders';

const routes = [
  {
    path: "/",
    name: 'home',
    component: Home,
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
  },
];

const router = new VueRouter({
  routes, // short for 'routes: routes'
  mode: 'history',
});

export default router;