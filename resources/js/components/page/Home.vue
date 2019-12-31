<template>
    <v-flex>
        <v-data-table
            v-model="selected"
            :headers="headers"
            :items="items"
            item-key="id"
            show-select
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar color="indigo" class="white--text">ブログ一覧</v-toolbar>
            </template>
        </v-data-table>
    </v-flex>
</template>

<script>
  import { BLOG } from "../../api/endpoint";
  import { mapGetters } from "vuex";

  export default {
    name: "Home",
    data() {
      return {
        selected: [],
        items: [],
        headers: [
          { text: '#', value: 'id' },
          { text: 'タイトル', value: 'title' },
          { text: '内容', value: 'body' },
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

      axios.defaults.headers.common['Authorization'] = `bearer ${this.token}`
      const { data } = await axios.get(BLOG, {});
      this.items = data.content;
    }
  }
</script>

<style scoped>

</style>
