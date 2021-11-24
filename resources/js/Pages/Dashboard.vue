<template>
    <div>

            <v-toolbar dense elevation="1">
            <h2>dashboard</h2>

            </v-toolbar>


            <v-card  class="my-1">
                 <v-card-text>
                <v-row>
                    <v-col>

                <v-btn small @click="goUsers">Test Usuarios</v-btn>
                    </v-col>
                </v-row>
                 </v-card-text>
            </v-card>

    </div>
</template>

<script>


export default {
    components: {

    },
    data() {
        return {

        };
    },
    mounted() {

    },
    methods: {
        goUsers() {

            this.setMyHistoryUrl();

            this.$inertia.get(route("users.index"));
        },
    },
};
</script>
