<template>
    <app-layout :input_loading.sync="input_loading">
        <template #header>
            <h2>Users</h2>
            <v-spacer></v-spacer>
            <menuope :id="user.id" :input_loading.sync="input_loading"></menuope>
        </template>
        <v-container>
            <pre>{{user}}</pre>
        </v-container>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import Menuope from "./Menuope";
export default {
    components: {
        AppLayout,
        Menuope
    },
    data(){
        return {
            input_loading: false,
        }
    },
    props:{
        user:{
            type: Object,
            required: true
        }
    },
    mounted(){


    }
}
</script>
