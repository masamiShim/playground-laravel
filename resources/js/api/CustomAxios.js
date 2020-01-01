import Vue from 'vue'
import Axios from 'axios'
import Cookies from "js-cookie";

const http = Axios.create({
    //withCredentials: true
})

/**
 * jwtのトークンセットするのをデフォ化する。(一応あれば設定して、なければ401が返ってくるでしょ。)
 */
http.interceptors.request.use(request => {
    const token = Cookies.get('vuex') ? JSON.parse(Cookies.get('vuex')).token : null;
    console.log('in intercepter requested');
    console.log(token);
    if (token) {
        console.log('in intercepter set token');
        console.log(http);
        http.defaults.headers.common[ 'Authorization' ] = `bearer ${token}`
    }
    return request
})

/**
 * responseでtoast出すかどうかを共通化
 */
http.interceptors.response.use((response) => {
    if (response.data.message) {
        showSuccessToast(response.data.message)
    }

    /*
    if(response.data.status !== 200) {
        console.log('showToast');
        showToast()
    }
    */
    return Promise.resolve(response)
}, (error) => {
    if ([401, 500].includes(error.response.status)) {
        showErrToast(error.response.data.message);
    }
    return Promise.reject(error)
});

function showErrToast(message) {
    Vue.toasted.clear();
    Vue.toasted.error(message);
    setTimeout(() => {
        Vue.toasted.clear();
    }, 2500)
}

function showSuccessToast(message) {
    Vue.toasted.clear();
    Vue.toasted.success(message);
    setTimeout(() => {
        Vue.toasted.clear();
    }, 2500)
}

export default http
