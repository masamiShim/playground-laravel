import Vue from 'vue'
import Axios from 'axios'

const http = Axios.create({
    //withCredentials: true
})

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
