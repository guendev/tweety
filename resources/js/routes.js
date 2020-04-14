import VueRouter from "vue-router";

import Login from './components/include/Auth/Login';
import Register from './components/include/Auth/Register';
import Forgot from './components/include/Auth/Forgot';
let routes = [
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/register',
        component: Register,
        name: 'register'
    },
    {
        path: '/forgot',
        component: Forgot,
        name: 'forgot'
    }
];

export default new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'active'
})
