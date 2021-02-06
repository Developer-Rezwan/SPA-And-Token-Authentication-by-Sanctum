import {createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../pages/Dashboard';
import Home from '../pages/Home';
import Login from '../pages/Login';
import Register from '../pages/Register';

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
        meta: {authOnly : true}
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: { guestOnly: true },
    },
    {
        path: "/register",
        name: "register",
        component: Register,
        meta : {guestOnly : true}
    }
];

function isLoggedIn() {
    return localStorage.getItem('auth');
}
const router = createRouter({
    history: createWebHistory(),
    routes
});
router.beforeEach((to) => {
if (to.meta.authOnly && !isLoggedIn()) {
    return {
      path: '/login',
      query: { redirect: to.fullPath },
    }
}
else if (to.meta.guestOnly && isLoggedIn()) {
    return {
      path: '/dashboard',
    }
}
else {
    return true;
    }
});

export default router;
