<template>
    <v-card
        class="mx-auto pa-0"
        elevation="4"
        width="1200"
    >
        <v-slide-group
            v-model="model"
            class="pa-2"
            mandatory
            show-arrows
        >
            <v-slide-item
                v-for="(post, index) in posts"
                :key="post.id"
                v-slot:default="{ active, toggle }"
            >
                <v-card
                    :color="index === selected ? '#fefefe' : ''"
                    class="ma-4"
                    height="400"
                    width="300"
                    @click="selectedPost({item: post, index: index})"
                >
                    <v-row
                    >
                        <v-col cols="12" class="pt-0">
                            <v-img
                                src="https://picsum.photos/id/11/500/300"
                                lazy-src="https://picsum.photos/id/11/10/6"
                                aspect-ratio="1"
                                class="grey lighten-2"
                                max-width="400"
                                height="150"
                            ></v-img>
                        </v-col>
                        <v-col cols="10" offset="1" class="pa-0 pt-2 text-right">
                            <span class="small grey--text">{{post.posted_at}}</span>
                        </v-col>
                        <v-col cols="11" offset="1" class="pa-0">
                            {{post.title}}
                        </v-col>
                        <v-col cols="11" offset="1" class="pa-0">
                            {{post.body}}
                        </v-col>
                    </v-row>
                </v-card>
            </v-slide-item>
        </v-slide-group>
    </v-card>
</template>

<script>
  export default {
    name: "BlogShowPostsList",
    props: {
      posts: {
        type: Array,
        required: true
      },
      selected: {
        type: Number,
        required: true,
      }
    },
    data() {
      return {
        model: false
      }
    },
    methods: {
      selectedPost(payload) {
        this.$emit('selected-post', payload.item);
        this.$emit('update:selectedValues', [...payload.index])
        this.$emit('change');
      }
    }
  }
</script>

<style scoped>

</style>
