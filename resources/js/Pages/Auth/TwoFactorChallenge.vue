<template>
    <v-app>
        <v-container class="mt-12">
            <v-layout row wrap align-center>
                <v-flex>
                    <v-card class="mx-auto" max-width="600">
                        <v-toolbar color="primary" dark>
                            <v-toolbar-title
                                >Enter Auth code</v-toolbar-title
                            >
                            <v-spacer></v-spacer>
                            <v-btn icon @click="home">
                                <v-icon>mdi-home-outline</v-icon>
                            </v-btn>
                        </v-toolbar>
                        <v-container fluid>
                            <v-card-text>

                            <p v-if="! recovery">
                                Please confirm access to your account by entering the authentication code provided by your authenticator application.
                            </p>

                            <p v-else>
                                Please confirm access to your account by entering one of your emergency recovery codes.
                            </p>



                                <v-text-field
                                    ref="code"
                                    v-if="! recovery"
                                    v-model="form.code"
                                    label="Code"
                                    v-validate="'required|numeric'"
                                    :error-messages="errors.collect('code')"
                                    data-vv-name="code"
                                    data-vv-as="code"
                                    v-on:keyup.enter="submit"
                                ></v-text-field>
                                <v-text-field
                                    v-else
                                    ref="recovery_code"
                                    v-model="form.recovery_code"
                                    label="Recovery Code"
                                    v-validate="'required'"
                                    :error-messages="errors.collect('recovery_code')"
                                    data-vv-name="recovery_code"
                                    data-vv-as="recovery_code"
                                    v-on:keyup.enter="submit"
                                ></v-text-field>

                                <v-row>
                                    <v-col cols="9">
                                        <v-btn text small @click="toggleRecovery" color="primary">
                                            {{ computedLabel }}
                                        </v-btn>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-spacer></v-spacer>
                                        <v-btn small @click="submit" :loading="form.processing">
                                            Login
                                        </v-btn>
                                    </v-col>
                                </v-row>
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

        data() {
            return {

                recovery: false,
                form: this.$inertia.form({
                    code: '',
                    recovery_code: '',
                })
            }
        },
        computed: {
            computedLabel(){
                return !this.recovery ? 'Use a recovery code' : 'Use an authentication code';
            }
        },
        mounted(){

        },
        methods: {
            toggleRecovery() {
                this.recovery ^= true

                this.$nextTick(() => {
                    if (this.recovery) {
                        this.$refs.recovery_code.focus()
                        //this.$nextTick(() => this.$refs.recovery_code.focus())
                        this.form.code = '';
                    } else {
                        this.$refs.code.focus()
                       // this.$nextTick(() => this.$refs.code.focus())
                        this.form.recovery_code = ''
                    }
                })
            },
            home() {
                this.form.get(this.route("home"));
            },
            submit() {

                this.$validator.validateAll().then((result) => {
                    if (result){
                        this.form.post(this.route('two-factor.login'))
                    }
                });
            }
        }
    }
</script>
