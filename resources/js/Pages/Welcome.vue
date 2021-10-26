<template>
    <v-app>
        <v-main>
            <v-container>
                <v-row>
                    <v-col cols="12" md="8" offset-md="8" v-if="canLogin">
                        <v-btn
                            v-if="$page.props.user"
                            text
                            @click="dashboard"
                        >
                            <v-icon>mdi-desktop-mac-dashboard</v-icon> Dashboard
                        </v-btn>


                        <template v-else>

                                <v-btn
                                    text
                                    @click="login"
                                >
                                    <v-icon color="indigo">mdi-account</v-icon> Login
                                </v-btn>

                                <v-btn
                                    v-if="canRegister"
                                    text
                                    @click="register"
                                >
                                    <v-icon>mdi-account-plus</v-icon> Register
                                </v-btn>

                        </template>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>


<script>
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        },
        methods: {
            login(){
                this.$inertia.get(route('login'));
            },
            register(){
                this.$inertia.get(route('register'));
            },
            dashboard(){
                this.$inertia.get(route('dashboard'));
            }
        }
    }
</script>
