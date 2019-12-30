<template>
    <div>
        <ul>
            <li><router-link :to="{path: '/'}">ホーム</router-link></li>
            <li><router-link :to="{path: '/login'}">ログイン</router-link></li>
            <li><router-link :to="{path: '/home'}">ユーザ情報</router-link></li>
            <li><router-link @click="logout">ログアウト</router-link></li>
        </ul>
        <hr>
        <router-view></router-view>
    </div>
</template>

<script>
  export default {
    name: "App",
    methods: {
      logout() {
        axios.post('/api/logout').then(res => {
          axios.default.headers.common['Authorization'] = '';
          state.isLogin = false;
          this.$router.push({path: '/'});
        })
      }
    }
  }
</script>

<style scoped>

</style>
