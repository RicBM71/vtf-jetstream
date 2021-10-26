<template>
    <app-layout>
            <template #header>
                <h2>
                    Dashboard
                </h2>
            </template>

            <v-container>
                    Now you're logged in!!
            </v-container>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
    }
</script>
