<template>
    <v-layout justify-center align-center>
        <v-flex class="pa-5" xs8>
            <v-card xs8>
                <v-toolbar color="indigo" class="white--text">ログイン</v-toolbar>
                <v-card-text>
                    <v-form @submit.prevent="login">
                        <v-flex v-show="isError">認証に失敗しました。</v-flex>
                        <v-flex>
                            <v-text-field
                                type="email"
                                label="メールアドレス"
                                placeholder="hogehoge@mail.com"
                                prepend-icon="email"
                                v-model="email"
                            >
                            </v-text-field>
                        </v-flex>
                        <v-flex>
                            <v-text-field
                                type="password"
                                label="パスワード"
                                placeholder="hogehoge@mail.com"
                                prepend-icon="lock"
                                v-model="password"
                            ></v-text-field>
                        </v-flex>
                        <v-layout wrap>
                            <v-spacer></v-spacer>
                            <v-flex>
                                <v-spacer></v-spacer>
                                <v-flex>
                                    <v-btn type="submit" class="primary">ログイン</v-btn>
                                </v-flex>
                            </v-flex>
                        </v-layout>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>

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
    created() {
      const reason = this.$route.query.reason || null;
      if (reason) {
        this.$toasted.clear();
        this.$toasted.error("トークンの有効期限が切れたため再度ログインしてください。")
        setTimeout(() => {
          this.$toasted.clear()
        }, 2500)
      }
    },
    methods: {
      login() {

        this.isError = false;

        // ログイン処理
        this.$store.dispatch('authorize', {
          email: this.email,
          password: this.password
        }).then(() => {
          this.$store.dispatch('fetchAuth').then(() => {
              this.$nextTick(() => {
                this.$router.push({ path: '/home' })
              })
            }
          );
        }).catch((err) => {
          this.isError = true;
        });
      }
    },
    beforeRouteUpdate(enter, leave, next) {
      const reason = leave.query.reason || null;
      if (reason) {
        this.$router.push({path: '/login'})
      }
      next(enter);
    },
  }
</script>

<style scoped>

</style>
