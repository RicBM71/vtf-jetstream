<template>
    <v-app>
        <v-container class="mt-12">
            <v-layout row wrap align-center>
                <v-flex>
                    <v-card class="mx-auto" max-width="600">
                        <v-toolbar color="primary" dark>
                            <v-toolbar-title
                                >Forgot your password?</v-toolbar-title
                            >
                            <v-spacer></v-spacer>
                            <v-btn icon @click="home">
                                <v-icon>mdi-home-outline</v-icon>
                            </v-btn>
                        </v-toolbar>
                        <v-container fluid>
                            <v-card-text>
                                 <v-alert
                                    v-if="status"
                                    color="green lighten-2"
                                    dark
                                >
                                    {{ status }}

                                    </v-alert>
                                <p v-else>
                                    Forgot your password? No problem. Just let
                                    us know your email address and we will email
                                    you a password reset link that will allow
                                    you to choose a new one.
                                </p>
                                <v-form>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="form.email"
                                                label="Email"
                                                v-validate="'required|email'"
                                                :error-messages="errors.collect('email')"
                                                data-vv-name="email"
                                                data-vv-as="email"
                                                @keyup.enter="submit"
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="7"> </v-col>
                                        <v-col cols="4">
                                            <v-spacer></v-spacer>
                                            <v-btn
                                                small
                                                @click="submit"
                                                :loading="form.processing"
                                            >
                                                Email Password Reset Link
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </v-card-text>
                        </v-container>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-app>
</template>
<script>
export default {
    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: "",
            }),
        };
    },

    methods: {
        home() {
            this.$inertia.get(route("home"));
        },
        submit() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.form.post(this.route("password.email"), {
                        onFinish: () => {

                            const msg_valid = this.form.errors;
                            for (const prop in msg_valid) {
                                this.errors.add({
                                    field: prop,
                                    msg: `${msg_valid[prop]}`,
                                });
                            }
                        },
                    });
                }
            });
        },
    },
};
</script>
