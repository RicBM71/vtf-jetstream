<template>
    <app-layout :input_loading.sync="input_loading">
           <template #header>
            <v-toolbar dense elevation="1">
            <h2>dashboard</h2>

            </v-toolbar>
        </template>

            <v-card  class="my-1">
                 <v-card-text>
                <v-row>
                    <v-col>

                <v-btn small @click="goUsers">Test Usuarios</v-btn>
                    </v-col>
                </v-row>
                 </v-card-text>
            </v-card>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout,
    },
    data() {
        return {
            input_loading: false,
        };
    },
    mounted() {},
    methods: {
        goUsers() {
            //this.$emit('input_loading', true);
            this.setMyHistoryUrl();
            this.input_loading = true;

            this.$inertia.get(route("users.index"));
        },
    },
};
</script>
