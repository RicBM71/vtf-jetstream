<template>
    <app-layout>
        <template #header>
            <h2>Error {{ statusCode }}!!</h2>
        </template>
        <v-container>
            <v-card class="d-flex justify-center mb-6" flat tile>
                <v-alert dense outlined type="error">
                    {{ message }}, pulse
                    <inertia-link :href="route('dashboard')">
                        aquí
                    </inertia-link>
                    para volver a inicio
                </v-alert>
                
            </v-card>
        </v-container>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    // props:{
    //     users: {
    //         type: Array,
    //         required: true
    //     }
    // },
    props: ["statusCode", "message"],
    components: {
        AppLayout,
    },
    data() {
        return {};
    },
    mounted() {
        console.log("aa");
    },
};
</script>
