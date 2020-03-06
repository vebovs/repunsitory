import VueRouter from 'vue-router';
import store from './store';

import Admin from './components/admin/Dashboard.vue';
import Dashboard from './components/user/Dashboard.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';

const router = new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            if(store.state.token && store.state.role === 1) {
                next();
            } else {
                next('/');
            }
        }
    },
    {
        path: '/admin',
        name: 'admin',
        component: Admin,
        beforeEnter: (to, from, next) => {
            if(store.state.token && store.state.role === 2) {
                next();
            } else {
                next('/');
            }
        }
    }],
    mode: 'history',
    history: true
});

export default router;

