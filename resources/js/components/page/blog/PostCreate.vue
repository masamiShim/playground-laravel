<template>
    <v-flex>
        <v-card>
            <v-card-title>
                {{blog.title}}
            </v-card-title>
            <v-card-text>
                {{blog.body}}
            </v-card-text>
        </v-card>
        <v-divider/>
        <v-card>
            <v-card-text>
                <v-form @submit.prevent="create">
                    <v-flex>
                        <v-datetime-picker label="投稿日" v-model="form.posted_at"> </v-datetime-picker>
                    </v-flex>
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
  import { BLOG, POST } from "../../../api/endpoint";
  import { mapGetters } from "vuex";
  import { getWithToken } from "../../../api/ApiClient";

  export default {
    name: "PostCreate",
    data() {
      return {
        blog: {
          title: "",
          body: ""
        },
        form: {
          posted_at: "",
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
    async created() {
      const blog_id = this.$route.params.blog_id;
      const data = await getWithToken(`${BLOG}/${blog_id}`, this.token);
      if (data.status === 200) {
        this.blog.title = data.content.title;
        this.blog.body = data.content.body;
        this.form.blog_id = blog_id;
      }
      this.form.posted_at = this.$dj().toDate();
    },
    methods: {
      async create() {
        // 登録

        $http.defaults.headers.common['Authorization'] = `bearer ${this.token}`
        const { data } = await $http.post(POST, {
          blog_id: this.form.blog_id,
          posted_at: this.$dj(this.form.posted_at.toLocaleString()).format('YYYY-MM-DD HH:mm:ss'),
          title: this.form.title,
          body: this.form.body
        });
        if (data.status === 200) {
          await this.$router.push({ path: '/blog' });
        }
      }
    }
  }
</script>

<style scoped>

</style>
