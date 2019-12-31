<template>
    <v-flex>
        <v-data-table
            v-model="selected"
            :headers="headers"
            :items="items"
            item-key="id"
            show-select
            class="elevation-2"
        >
            <template v-slot:top>
                <v-flex>
                    <v-toolbar xs2 color="indigo" class="white--text">
                        ブログ検索
                    </v-toolbar>
                </v-flex>
            </template>
        </v-data-table>
        <blog-search-condition :title="form.blog_title" :name="form.blog_name">
        </blog-search-condition>

    </v-flex>
</template>

<script>
  import { BLOG } from "../../../api/endpoint";
  import { mapGetters } from "vuex";
  import BlogSearchCondition from "./parts/BlogSearchCondition";

  export default {
    name: "BlogSearch",
    components: { BlogSearchCondition },
    data() {
      return {
        form: {
          blog_title: '',
          blog_name: '',
        },
        selected: [],
        items: [],
        headers: [
          { text: '#', value: 'id' },
          { text: 'タイトル', value: 'title' },
          { text: '内容', value: 'body' },
          { text: '投稿者', value: 'created_by' },
          { text: '作成日時', value: 'created_at' },
        ]
      }
    },
    computed: {
      ...mapGetters({
        token: 'token'
      })
    },
    async created() {

      $http.defaults.headers.common[ 'Authorization' ] = `bearer ${this.token}`
      const { data } = await $http.get(BLOG, {});
      this.items = data.content;
    },
    methods: {
      post(item) {
        this.$router.push({ name: 'post.create', params: { blog_id: item.id } })
      }
    }
  }
</script>

<style scoped>

</style>
