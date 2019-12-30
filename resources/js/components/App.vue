<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            app
        >
            <v-list dense>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            <router-link :to="{path: '/home'}">Home</router-link>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>mdi-pencil</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            <router-link :to="{path: '/blog/new'}">新規投稿</router-link>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link @click="logout">
                    <v-list-item-action>
                        <v-icon>mdi-logout</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            ログアウト
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            app
            color="indigo"
            dark
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>
            <v-toolbar-title>Blog</v-toolbar-title>
        </v-app-bar>

        <v-content>
            <v-container
                class="fill-height"
                fluid
            >
                <router-view></router-view>
            </v-container>
        </v-content>
        <v-footer
            color="indigo"
            app
        >
            <span class="white--text">&copy; 2019 feitech</span>
        </v-footer>
    </v-app>
</template>

<script>
  export default {
    name: "App",
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
    }),
    methods: {
      async logout() {
        const { status, data } = await axios.post('/api/logout');
        if (status === 200) {
          axios.defaults.headers.common[ 'Authorization' ] = '';
          state.isLogin = false;
          await this.$router.push({ path: '/login' });
        } else {
          alert(data.message);
        }
      }
    }
  }
</script>

<style scoped>

</style>
