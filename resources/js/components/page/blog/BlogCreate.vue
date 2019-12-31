<template>
    <v-flex>
        <v-card>
            <v-card-text>
                <v-form @submit.prevent="create">
                    <v-flex>
                        <v-text-field label="タイトル" v-model="form.title"></v-text-field>
                    </v-flex>
                    <v-flex>
                        <v-textarea
                            label="本文"
                            v-model="form.body"
                        ></v-textarea>
                    </v-flex>
                    <v-flex>
                        <v-btn type="submit" color="primary">登録する</v-btn>
                    </v-flex>
                </v-form>
            </v-card-text>
        </v-card>
    </v-flex>
</template>

<script>
  import { BLOG } from "../../../api/endpoint";
  import { mapGetters } from "vuex";

  export default {
    name: "BlogCreate",
    data() {
      return {
        form: {
          title: "",
          body: "",
        }
      }
    },
    computed: {
      ...mapGetters({
        token: 'token'
      })
    },
    methods: {
      async create() {
        // 登録
        const { data } = await $http.post(BLOG, { title: this.form.title, body: this.form.body });
        if(data.status === 200) {
          await this.$router.push({path: '/home'});
        }
      }
    }
  }
</script>

<style scoped>

</style>
