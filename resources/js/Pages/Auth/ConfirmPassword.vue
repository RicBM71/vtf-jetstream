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
                                <v-toolbar-title>Confirm password</v-toolbar-title>
                                <v-spacer></v-spacer>
                                <inertia-link :href="route('home')" class="text-sm text-gray-700 underline">
                                    <v-icon>mdi-home-outline</v-icon>
                                </inertia-link>
                            </v-toolbar>
                        </v-card-title>
                        <v-card-text>
                            <p>This is a secure area of the application. Please confirm your password before continuing.</p>
                            <v-form>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="form.password"
                                            label="Password"
                                            :error-messages="form.errors.password"
                                            v-on:keyup.enter="submit"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="9"></v-col>
                                    <v-col cols="2">
                                        <v-spacer></v-spacer>
                                        <v-btn small @click="submit" :disabled="form.processing">
                                            Confirm
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
                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.confirm'), {
                    onFinish: () => this.form.reset(),
                })
            }
        }
    }
</script>
