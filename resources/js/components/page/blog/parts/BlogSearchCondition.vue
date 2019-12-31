<template>
    <v-dialog v-model="dialog" max-width="600px">
        <template v-slot:activator="{ on }">
            <v-card-text style="height: 100px;">
                <v-fab-transition>
                    <v-btn
                        v-on="on"
                        color="pink"
                        dark
                        absolute
                        top
                        right
                        fab
                        style="z-index: 5"
                    >
                        <v-icon>search</v-icon>
                    </v-btn>
                </v-fab-transition>
            </v-card-text>
        </template>
        <v-card>
            <v-toolbar color="indigo" class="text-white darken-3">検索条件</v-toolbar>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field label="投稿者" v-model="_name"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field label="タイトル" v-model="_title"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field
                                label="Legal last name*"
                                hint="example of persistent helper text"
                                persistent-hint
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field label="Email*" required></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field label="Password*" type="password" required></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-select
                                :items="['0-17', '18-29', '30-54', '54+']"
                                label="Age*"
                                required
                            ></v-select>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-autocomplete
                                :items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                                label="Interests"
                                multiple
                            ></v-autocomplete>
                        </v-col>
                    </v-row>
                </v-container>
                <small>*indicates required field</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
                <v-btn color="blue darken-1" text @click="dialog = false">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
  export default {
    name: "BlogSearchCondition",
    props: {
      title: {
        type: String,
        required: true
      },
      name: {
        type: String,
        required: true
      }
    },
    data() {
      return {
        dialog: false
      }
    },
    computed: {
      _title: {
        get() {
          return this.title;
        },
        set(val) {
          this.$emit('update:form.blog_title', val)
        },
      },
      _name: {
        get() {
          return this.name;
        },
        set(val) {
          this.$emit('update:form.blog_name', val)
        }
      }
    }
  }
</script>

<style scoped>

</style>
