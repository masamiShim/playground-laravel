<template>
    <div class="pa-2">
        <v-card-text>
            <v-form>
                <v-textarea
                    outlined
                    label="コメント"
                    v-model="comment"></v-textarea>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer/>
            <v-btn color="primary" @click.prevent="send">コメント</v-btn>
        </v-card-actions>
    </div>
</template>

<script>
  import { COMMENT } from "../../../../api/endpoint";

  export default {
    name: "CommentInput",
    props: {
      post_id: {
        type: Number,
        required: true,
      }
    },
    data() {
      return {
        comment: ''
      }
    },
    methods: {
      send() {
        const { data } = $http.post(COMMENT, { post_id: this.post_id, body: this.comment });
        if (data.status === 200) {
          // fetchし直す？
        }
      }
    }
  }
</script>

<style scoped>

</style>
