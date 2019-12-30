import Vue from 'vue';
import VueRouter from "vue-router";
import Login from "./components/page/Login";
import Home from "./components/page/Home";
import Blank from "./components/Blank";
import { W_LOGIN } from "./api/webRoute";

Vue.use(VueRouter);

const routes = [
    { path: '/', component: Blank },
    { path: '/login', component: Login },
    { path: '/home', component: Home, meta: { requiresAuth: true } }
];

const router = new VueRouter({
    mode: 'history',
    routes
});


router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (state.isLogin === false) {
            next({
                path: W_LOGIN,
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next()
    }
});

export default router;
