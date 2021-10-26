<template>
    <v-app>
        <v-container>
            <v-row>
                <v-col cols="12" md="4"></v-col>
                <v-col cols="12" md="4">
                    <v-card
                        class="mx-auto"
                    >
                        <v-card-title>
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Enter Auth Code</v-toolbar-title>
                                <v-spacer></v-spacer>
                                <inertia-link :href="route('home')" class="text-sm text-gray-700 underline">
                                    <v-icon>mdi-home-outline</v-icon>
                                </inertia-link>
                            </v-toolbar>
                        </v-card-title>
                        <v-card-text>

                            <p v-if="! recovery">
                                Please confirm access to your account by entering the authentication code provided by your authenticator application.
                            </p>

                            <p v-else>
                                Please confirm access to your account by entering one of your emergency recovery codes.
                            </p>


                            <v-form>
                                <v-text-field
                                    v-if="! recovery"
                                    v-model="form.code"
                                    label="Code"
                                    :error-messages="form.errors.code"
                                    v-on:keyup.enter="submit"
                                ></v-text-field>
                                <v-text-field
                                    v-else
                                    v-model="form.recovery_code"
                                    label="Recovery Code"
                                    :error-messages="form.errors.recovery_code"
                                    v-on:keyup.enter="submit"
                                ></v-text-field>

                                <v-row>
                                    <v-col cols="9">
                                        <v-btn small @click="toggleRecovery" :disabled="form.processing">
                                            {{ computedLabel }}
                                        </v-btn>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-spacer></v-spacer>
                                        <v-btn small @click="submit" :disabled="form.processing">
                                            Login
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
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
        methods: {
            toggleRecovery() {
                this.recovery ^= true

                this.$nextTick(() => {
                    if (this.recovery) {
                        this.$refs.recovery_code.focus()
                        this.form.code = '';
                    } else {
                        this.$refs.code.focus()
                        this.form.recovery_code = ''
                    }
                })
            },

            submit() {
                this.form.post(this.route('two-factor.login'))
            }
        }
    }
</script>
