<template>
    <div>
        <p v-show="isError">認証に失敗しました。</p>
        <form @submit.prevent="login">
            <h1>ログイン</h1>
            <div>
                <label>メールアドレス：</label> <input type="email" v-model="email"/>
            </div>
            <div>
                <label>パスワード：</label><input type="password" v-model="password"/>
            </div>
            <ul>
                <li>
                    <button type="submit">ログイン</button>
                </li>
            </ul>
        </form>
    </div>
</template>

<script>
  export default {
    name: "Login",
    data() {
      return {
        isError: false,
        email: '',
        password: '',
      }
    },
    methods: {
        login() {
          axios.post('/api/login', {
            email: this.email,
            password: this.password
          }).then(res => {
            const token = res.data.access_token;
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            state.isLogin = true;
            this.$router.push({path: '/'})
          }).catch(err => {
            this.isError = true;
          });
        }
    }
  }
</script>

<style scoped>

</style>
