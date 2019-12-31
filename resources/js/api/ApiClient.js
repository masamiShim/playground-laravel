export async function getWithToken(url, token = null, params = {}) {
    if (token) {
        $http.defaults.headers.common[ 'Authorizaion' ] = `Bearer ${token}`
    }
    const { data } = await $http.get(url, params);
    return data
}


export async function postWithToken(url, token = null, params = {}) {
    if (token) {
        $http.defaults.headers.common[ 'Authorizaion' ] = `Bearer ${token}`
    }
    const { data } = await $http.post(url, params);
    return data
}
