import Vue from 'vue';
import VueRouter from "vue-router";
import Login from "./components/page/Login";
import { W_LOGIN } from "./api/webRoute";
import BlogCreate from "./components/page/blog/BlogCreate";
import BlogIndex from "./components/page/blog/BlogIndex";
import BlogSearch from "./components/page/blog/BlogSearch";
import PostCreate from "./components/page/blog/PostCreate";

Vue.use(VueRouter);

const routes = [
    { path: '/', component: BlogIndex, requiredAuth: true },
    { path: '/home', component: BlogIndex, requiredAuth: true },
    { path: '/login', component: Login },
    { path: '/blog', name: 'blog.search', component: BlogSearch, requiredAuth: true },
    { path: '/blog/new', name: 'blog.create', component: BlogCreate, requiredAuth: true },
    { path: '/post/new', name: 'post.create', component: PostCreate, requiredAuth: true },

];

const router = new VueRouter({
    mode: 'history',
    routes
});


router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiredAuth)) {
        if (!cookies.get("isLogin")) {
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
