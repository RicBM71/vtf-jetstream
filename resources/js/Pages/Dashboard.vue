<template>
    <app-layout :appname="appname" :input_loading.sync="input_loading">
        <template #header>
            <h2>Dashboard</h2>
        </template>

        <v-container> **Now you're logged in!!

            <v-btn @click="goUsers">Users</v-btn>

            <inertia-link :href="route('users.index')">
                Usuarios
            </inertia-link>
         </v-container>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";

export default {
    props:['appname'],
    components: {
        AppLayout,
        Welcome,
    },
    data(){
        return {
            input_loading: false,
        }
    },
    mounted(){

    },
    methods:{
        goUsers(){
            //this.$emit('input_loading', true);
            this.input_loading = true;

            this.$inertia.get(route('users.index'));
        }
    }
};
</script>
