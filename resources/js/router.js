import Vue from 'vue';
import VueRouter from "vue-router";
import Login from "./components/page/Login";
import Home from "./components/page/Home";
import { W_LOGIN } from "./api/webRoute";
import BlogCreate from "./components/page/blog/BlogCreate";
import BlogIndex from "./components/page/blog/BlogIndex";

Vue.use(VueRouter);

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/blog', component: BlogIndex, requiredAuth: true },
    { path: '/blog/new', name: 'blog.create', component: BlogCreate, requiredAuth: true }

];

const router = new VueRouter({
    mode: 'history',
    routes
});


router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiredAuth)) {
        if (!state.isLogin) {
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
