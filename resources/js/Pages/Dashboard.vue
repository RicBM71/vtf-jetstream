<template>
    <app-layout>
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
    components: {
        AppLayout,
        Welcome,
    },
    methods:{
        goUsers(){
            this.$inertia.get(route('users.index'))
            onFinish: () => (this.enabling = false)
        }
    }
};
</script>
