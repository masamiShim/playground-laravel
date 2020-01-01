<template>
    <div>
        <v-list-item two-line>
            <v-list-item-content>
                <div class="overline mb-4">ジャンル</div>
                <v-list-item-title class="headline mb-1">{{blog.title}}</v-list-item-title>
            </v-list-item-content>

            <v-list-item-avatar
                tile
                size="80"
                color="grey"
            ></v-list-item-avatar>
        </v-list-item>
        <v-card-text>
            {{blog.body}}
        </v-card-text>
    </div>
</template>

<script>
  export default {
    name: "BlogDetailSummary",
    props: {
      blog: {
        type: Object,
        required: true
      }
    }
  }
</script>

<style scoped>

</style>
