<template>
    <v-flex>
        <v-card class="elevation-1">
            <v-toolbar color="indigo" class="white--text">
                検索条件
            </v-toolbar>
            <v-card-text>
                <v-layout wrap justify-start>
                    <v-flex xs5 mr-5>
                        <v-text-field label="投稿者" v-model="form.blog_user"></v-text-field>
                    </v-flex>
                    <v-flex xs5>
                        <v-text-field label="タイトル" v-model="form.blog_title"></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>
        <v-divider/>
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
                        <v-flex xs2>
                            <v-text-field></v-text-field>
                        </v-flex>
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
    name: "BlogSearch",
    data() {
      return {
        form: {
          blog_title: '',
          blog_user: "",
        },
        selected: [],
        items: [],
        headers: [
          { text: '#', value: 'id' },
          { text: 'タイトル', value: 'title' },
          { text: '内容', value: 'body' },
          { text: '投稿者', value: 'created_by' },
          { text: '作成日時', value: 'created_at' },
          { text: '', value: 'action', sortable: false }
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
