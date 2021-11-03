<template>
    <app-layout :appname="appname">
        <template #header>
            <h2>Error {{statusCode }}!!</h2>
        </template>
        <v-container>

            <v-card class="d-flex justify-center mb-6" flat tile>
                <v-alert outlined type="error">
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
    props: ["statusCode", "message","appname"],
    components: {
        AppLayout,
    },
    data() {
        return {};
    },
    mounted() {

    },
};
</script>
