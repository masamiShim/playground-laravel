import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";
import Cookies from 'js-cookie'

import { actions, getters, mutations, state } from './auth/auth'

Vue.use(Vuex);

const options  = {
    reducer: state => ({
        auth: state.auth,
        isLogin: state.isLogin,
        token: state.token
    }),
    storage: {
        getItem: key => Cookies.get(key),
        setItem: (key, value) =>  Cookies.set(key, value, {expires: 7, secure: false}),
        removeItem: key => Cookies.remove(key)
    }
};

export const store = new Vuex.Store({
    actions,
    getters,
    state,
    mutations,
    plugins: [
        // cookieに保存してみる
        createPersistedState(options)
    ]
})
