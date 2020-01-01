<template>
    <v-flex>
        <blog-search-condition :title="form.blog_title" :name="form.blog_name">
        </blog-search-condition>
        <v-layout wrap>
            <v-flex xs12 md5 class="mb-6 offset-1" v-for="item in items" :key="item.id">
                <v-card class="elevation-2 px-2" flat tile>
                    <blog-detail-summary :blog="item"></blog-detail-summary>
                    <v-card-actions>
                        <v-btn color="primary" @click.prevent="show(item.id)">ブログを見る</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="favorite(item.id)">
                            <v-expand-transition>
                                <v-icon v-if="item.is_favorite" color="amber accent-2">mdi-star</v-icon>
                                <v-icon v-else color="amber accent-2">mdi-star-outline</v-icon>
                            </v-expand-transition>
                        </v-btn>
                        <v-btn icon @click="like(item.id)">
                            <v-expand-transition>
                                <v-icon v-if="item.is_like" color="pink accent-2">mdi-heart</v-icon>
                                <v-icon v-else color="pink accent-2">mdi-heart-outline</v-icon>
                            </v-expand-transition>
                        </v-btn>
                    </v-card-actions>
                    <v-card-text></v-card-text>
                </v-card>
            </v-flex>
            <v-spacer/>
        </v-layout>
    </v-flex>
</template>

<script>
  import { BLOG, BLOG_FAVORITE, BLOG_LIKE } from "../../../api/endpoint";
  import { mapGetters } from "vuex";
  import BlogSearchCondition from "./parts/BlogSearchCondition";
  import BlogDetailSummary from "./parts/BlogDetailSummary";

  export default {
    name: "BlogSearch",
    components: { BlogDetailSummary, BlogSearchCondition },
    data() {
      return {
        form: {
          blog_title: '',
          blog_name: '',
        },
        selected: [],
        items: [],
      }
    },
    computed: {
      ...mapGetters({
        token: 'token'
      })
    },
    async created() {
      $http.defaults.headers.common[ 'Authorization' ] = `bearer ${this.token}`;
      const { data } = await $http.get(BLOG, {});
      this.items = data.content;
    },
    methods: {
      show(id) {
        // パスパラメータ使う場合はこんな感じ
        this.$router.push({ name: 'blog.show', params: { id: id } })
      },
      favorite(id) {
        const { data } = $http.post(BLOG_FAVORITE, { blog_id: id });
      },
      like(id) {
        const { data } = $http.post(BLOG_LIKE, { blog_id: id });
      }
    }
  }
</script>

<style scoped>

</style>
