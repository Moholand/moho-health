import VueRouter from 'vue-router';
import Home from './home/Home';
import About from './about/About';
import Doctors from './admin/doctors/Doctors';
import AdminSliders from './admin/sliders/AdminSliders';
import AdminDepartments from './admin/departments/AdminDepartments';
import Department from './user/departments/Department';
import DoctorsDetail from './user/doctors/DoctorsDetail';
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
    path: "/admin/doctors",
    name: 'admin.doctors',
    component: Doctors,
    meta: { requiresAuth: true }
  },
  {
    path: "/admin/sliders",
    name: 'admin-sliders',
    component: AdminSliders,
    meta: { requiresAuth: true }
  },
  {
    path: "/admin/departments",
    name: 'admin-departments',
    component: AdminDepartments,
    meta: { requiresAuth: true }
  },
  {
    path: "/departments/:department",
    name: 'departments.show',
    component: Department,
  },
  {
    path: "/doctors/:doctor",
    name: 'doctors.detail',
    component: DoctorsDetail,
  },
];

const router = new VueRouter({
  routes, // short for 'routes: routes'
  mode: 'history',
});

export default router;