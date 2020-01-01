import Vue from 'vue';
import VueRouter from "vue-router";
import Login from "./components/page/Login";
import { W_LOGIN } from "./api/webRoute";
import BlogCreate from "./components/page/blog/BlogCreate";
import BlogIndex from "./components/page/blog/BlogIndex";
import BlogSearch from "./components/page/blog/BlogSearch";
import PostCreate from "./components/page/blog/PostCreate";
import Cookies from 'js-cookie'
import { store } from './store/index'
import BlogShow from "./components/page/blog/BlogShow";

Vue.use(VueRouter);

const routes = [
    { path: '/home', component: BlogIndex, meta: { requiredAuth: true } },
    { path: '/login', component: Login },
    { path: '/blog', name: 'blog.search', component: BlogSearch, meta: { requiredAuth: true } },
    { path: '/blog/new', name: 'blog.create', component: BlogCreate, meta: { requiredAuth: true } },
    { path: '/post/new', name: 'post.create', component: PostCreate, meta: { requiredAuth: true } },
    { path: '/blog/show/:id', name: 'blog.show', component: BlogShow, meta: { requiredAuth: true } },
    { path: '*', component: BlogIndex, meta: { requiredAuth: true } },
];

const router = new VueRouter({
    mode: 'history',
    routes
});


router.beforeEach(async (to, from, next) => {
    if (to.matched.some(record => record.meta.requiredAuth)) {
        const val = Cookies.get('vuex') ? JSON.parse(Cookies.get('vuex')).isLogin : false;
        if (!val) {
            //クッキー無くなった時も考慮
            await store.commit('destroyAuth');
            await next({
                path: W_LOGIN,
                query: { redirect: to.fullPath, reason: 'expired' },
            })

        } else {
            next()
        }
    } else {
        next()
    }
});

export default router;
