<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-show="isLogin"
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
                        <v-icon>search</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            <router-link :to="{path: '/blog'}">ブログ検索</router-link>
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
                <v-list-item link @click.prevent.stop="logout">
                    <v-list-item-action>
                        <v-icon>mdi-logout</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            <router-link :to="{path: '/blog/new'}">ログアウト</router-link>
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
            <v-app-bar-nav-icon v-show="isLogin" @click.stop="drawer = !drawer"/>
            <v-toolbar-title>Blog</v-toolbar-title>
        </v-app-bar>

        <v-content>
            <v-container
                class="fill-height"
                fluid
            >
                <transition mode="out-in">
                    <router-view></router-view>
                </transition>
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
  import { mapGetters } from "vuex";

  export default {
    name: "App",
    props: {
      source: String,
    },
    data: () => ({
      drawer: false,
    }),
    computed: {
      ...mapGetters({
        isLogin: 'isLogin'
      })
    },
    methods: {
      logout() {
        // ログアウト処理
        this.$store.dispatch('destroyAuth').then(() => {
          this.drawer = false
          this.$router.push({ path: '/login' });
        })
      }
    }
  }
</script>

<style scoped>
    .v-enter-active, .v-leave-active {
        transition: opacity .5s;
    }
    .v-enter, .v-leave-to {
        opacity: 0;
    }
</style>
