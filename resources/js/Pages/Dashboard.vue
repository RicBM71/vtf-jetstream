<template>
    <app-layout :input_loading.sync="input_loading">
        <template #header>
            <h2>Dashboard</h2>
        </template>

        <v-container> **Estás logado!!

            <v-btn text @click="goUsers">Test Usuarios</v-btn>

         </v-container>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";

export default {
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
            this.setMyHistoryUrl();
            this.input_loading = true;

            this.$inertia.get(route('users.index'));
        }
    }
};
</script>
