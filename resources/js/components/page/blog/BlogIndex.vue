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
                        マイブログ
                    </v-toolbar>
                </v-flex>
            </template>
            <template v-slot:item.action="{ item }">
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-icon
                            class="mr-2"
                            v-on="on"
                        >
                            edit
                        </v-icon>
                    </template>
                    <span>ブログを編集する</span>
                </v-tooltip>
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-icon
                            class="mr-2"
                            v-on="on"
                        >
                            delete
                        </v-icon>
                    </template>
                    <span>ブログを削除する</span>
                </v-tooltip>
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-icon
                            class="mr-2"
                            v-on="on"
                            @click="post(item)"
                        >
                            mdi-comment-edit
                        </v-icon>
                    </template>
                    <span>投稿する</span>
                </v-tooltip>
            </template>
        </v-data-table>
    </v-flex>
</template>

<script>
  import { BLOG } from "../../../api/endpoint";
  import { mapGetters } from "vuex";

  export default {
    name: "BlogIndex",
    data() {
      return {
        selected: [],
        items: [],
        headers: [
          { text: '#', value: 'id' },
          { text: 'タイトル', value: 'title' },
          { text: '内容', value: 'body' },
          { text: '作成日時', value: 'created_at' },
          { text: '', value: 'action', sortable: false}
        ]
      }
    },
    computed: {
      ...mapGetters({
        token: 'token'
      })
    },
    async created() {

      $http.defaults.headers.common['Authorization'] = `bearer ${this.token}`
      const { data } = await $http.get(BLOG, {});
      this.items = data.content;
    },
    methods: {
      post(item) {
        this.$router.push({name: 'post.create', params: {blog_id: item.id}})
      }
    }
  }
</script>

<style scoped>

</style>
