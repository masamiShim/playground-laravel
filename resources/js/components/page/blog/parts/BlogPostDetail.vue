<template>
    <div>
        <v-card>
            <v-card-title>{{post.title}}</v-card-title>
            <v-card-text>{{post.body}}</v-card-text>
            <v-divider/>
            <comment-input :post_id="post.id"></comment-input>
        </v-card>
    </div>
</template>

<script>
  import CommentInput from "./CommentInput";

  export default {
    name: "BlogPostDetail",
    components: { CommentInput },
    props: {
      post: {
        type: Object,
        required: true
      }
    }
  }
</script>

<style scoped>

</style>
