<template>
    <v-flex>
        <v-card>
            <blog-detail-summary :blog="blog"/>
        </v-card>
        <v-divider/>
        <div class="mt-4 mb-2">最近の投稿</div>
        <blog-show-posts-list @selected-post="showIndex" :posts="posts" :selected="selectedIndex"/>
        <v-divider/>
        <div class="mt-4 mb-2" ref="detail">投稿の詳細</div>
        <blog-post-detail v-if="selectedPost" :post="selectedPost"/>

    </v-flex>
</template>

<script>
  import BlogShowPostsList from "./parts/BlogShowPostsList";
  import BlogDetailSummary from "./parts/BlogDetailSummary";
  import { BLOG_DETAIL } from "../../../api/endpoint";
  import BlogPostDetail from "./parts/BlogPostDetail";

  export default {
    name: "BlogShow",
    components: { BlogPostDetail, BlogDetailSummary, BlogShowPostsList },
    data() {
      return {
        blog: {},
        posts: [],
        selectedIndex: 0
      }
    },
    async created() {
      const { data } = await $http.get(`${BLOG_DETAIL}/${this.$route.params.id}`);
      console.log(data);
      if (data.status === 200) {
        this.blog = data.content.blog;
        this.posts = data.content.posts;
      }
    },
    computed: {
      selectedPost() {
        return !this.posts ? {} : this.posts[ this.selectedIndex ]
      }
    },
    methods: {
      showIndex(post) {
        if (!post) {
          this.selectedIndex = 0;
          return
        }
        this.selectedIndex = this.posts.indexOf(post);
        const elem = this.$refs.detail;
        window.scrollTo(elem);
      }
    }

  }
</script>

<style scoped>

</style>
