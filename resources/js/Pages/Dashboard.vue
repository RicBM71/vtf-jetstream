<template>
    <app-layout :appname="appname">
        <template #header>
            <h2>Dashboard</h2>
        </template>

        <v-container> **Now you're logged in!!


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
    mounted(){

    },
    methods:{
        goUsers(){
            this.$inertia.get(route('users.index'));
        }
    }
};
</script>
