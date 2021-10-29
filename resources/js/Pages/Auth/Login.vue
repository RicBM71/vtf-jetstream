<template>
    <v-app>
        <v-container class="mt-12">
            <v-layout row wrap align-center>
                <v-flex>
                    <v-card class="mx-auto" max-width="600">
                        <v-toolbar color="primary" dark>
                            <v-toolbar-title
                                >Credentials</v-toolbar-title
                            >
                            <v-spacer></v-spacer>
                            <v-btn icon @click="home">
                                <v-icon>mdi-home-outline</v-icon>
                            </v-btn>
                        </v-toolbar>
                        <v-container fluid>
                            <v-card-text>

                            <v-form>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="form.email"
                                            label="Usuario"
                                            v-validate="'required|min:4'"
                                            :error-messages="errors.collect('email')"
                                            data-vv-name="email"
                                            data-vv-as="email"
                                            v-on:keyup.enter="submit"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="form.password"
                                            label="Password"
                                            v-validate="'required'"
                                            :error-messages="errors.collect('password')"
                                            data-vv-name="password"
                                            data-vv-as="password"
                                            type="password"
                                            v-on:keyup.enter="submit"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="9">
                                        <inertia-link v-if="canResetPassword" :href="route('password.request')">
                                            Forgot your password?
                                        </inertia-link>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-spacer></v-spacer>
                                        <v-btn small @click="submit" :loading="form.processing">
                                            Login
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
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                loading: false,
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            home() {
                this.form.get(this.route("home"));
            },
            submit() {
                if (this.loading === false){
                    this.loading = true;

                    this.$validator.validateAll().then((result) => {
                        if (result){
                            this.form
                                .transform(data => ({
                                    ... data,
                                    remember: this.form.remember ? 'on' : ''
                                }))
                                .post(this.route('login'), {
                                    onFinish: () =>  {
                                        const msg_valid = this.form.errors;
                                        for (const prop in msg_valid) {
                                            this.errors.add({
                                                field: prop,
                                                msg: `${msg_valid[prop]}`
                                            })
                                        }
                                        //this.form.reset('password');
                                        this.loading = false;
                                    }
                                })
                            }
                        else{
                            this.loading = false;
                        }
                    });
                }
            },
        }
    }
</script>
