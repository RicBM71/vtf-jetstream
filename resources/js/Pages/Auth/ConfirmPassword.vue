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
                                    <v-btn icon @click="home">
                                        <v-icon>mdi-home-outline</v-icon>
                                    </v-btn>
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
                                            @keyup.enter="submit"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="9"></v-col>
                                    <v-col cols="2">
                                        <v-spacer></v-spacer>
                                        <v-btn small @click="submit" :loading="form.processing">
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
            home() {
                this.form.get(this.route("home"));
            },
            submit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.form.post(this.route("password.confirm"), {
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
