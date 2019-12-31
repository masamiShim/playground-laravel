import * as types from './mutation-types'
import { LOGIN, LOGOUT, ME } from "../../api/endpoint";

export const state = {
    auth: {},
    isLogin: false,
    token: null
};

export const mutations = {
    [ types.AUTHORIZE ](state, token) {
        $http.defaults.headers.common[ 'Authorization' ] = `Bearer ${token}`;
        state.token = token
    },
    [ types.STORE_AUTH ](state, auth) {
        state.auth = auth;
        state.isLogin = true;
    },
    [ types.DESTROY_AUTH ](state) {
        state.auth = {};
        $http.defaults.headers.common[ 'Authorization' ] = '';
        state.isLogin = false;
    }
};


export const actions = {

    async authorize({ commit }, payload) {
        const { status, data } = await $http.post(LOGIN, payload);
        if (status === 200) {
            await commit(types.AUTHORIZE, data.access_token);
        }
    },

    // ユーザ情報の取得
    async fetchAuth({ commit }) {
        $http.defaults.headers.common[ 'Authorization' ] = `Bearer ${this.state.token}`;
        const { status, data } = await $http.get(ME, this.state.token);
        if (status === 200) {
            // ユーザ情報を保存
           await commit(types.STORE_AUTH, data);
        }
    },

    // ユーザ情報の破棄
    async destroyAuth({ commit }) {
        const { status } = await $http.post(LOGOUT, this.state.token);
        if (status === 200) {
            commit(types.DESTROY_AUTH);
        }
    }
};

export const getters = {
    isLogin: (state) => state.isLogin,
    user: (state) => state.auth,
    token: (state) => state.token,
};
