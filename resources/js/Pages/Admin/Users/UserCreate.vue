<template>
    <app-layout :input_loading.sync="input_loading">
        <template #header>
            <h2>Crear Usuario</h2>
            <v-spacer></v-spacer>
            <menuope :input_loading.sync="input_loading"></menuope>
        </template>
        <v-container>
            <v-card>
                <v-card-title color="indigo"> </v-card-title>
                <v-form @submit.prevent="store">
                    <v-card-text class="py-0">
                        <v-row>
                            <v-col cols="12" md="2">
                                <v-text-field
                                    label="Nombre"
                                    dense
                                    v-model="form.name"
                                    v-validate="'required|min:3'"
                                    :error-messages="errors.collect('name')"
                                    data-vv-name="name"
                                    data-vv-as="name"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2">
                                <v-text-field
                                    label="Usuario"
                                    dense
                                    v-model="form.username"
                                    v-validate="'required'"
                                    :error-messages="errors.collect('username')"
                                    data-vv-name="username"
                                    data-vv-as="username"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    label="Email"
                                    dense
                                    v-model="form.email"
                                    v-validate="'required|email'"
                                    :error-messages="errors.collect('email')"
                                    data-vv-name="email"
                                    data-vv-as="email"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2">
                                <v-btn
                                    block
                                    small
                                    type="submit"
                                    :loading="loading"
                                >
                                    Guardar
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-form>
            </v-card>
        </v-container>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import Menuope from "./Menuope";

export default {
    components: {
        AppLayout,
        Menuope,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: "POST",
                name: null,
                username: null,
                email: null,
            }),

            photoPreview: null,
            loading: false,
            input_loading: true,
        };
    },
    mounted(){
        this.input_loading = false;
    },
    methods: {
        store() {
            this.loading = true;

            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.form.post(route("users.store", { user: this.user }), {
                        preserveScroll: true,
                        onFinish: () => {
                            const msg_valid = this.form.errors;
                            for (const prop in msg_valid) {
                                this.errors.add({
                                    field: prop,
                                    msg: `${msg_valid[prop]}`,
                                });
                            }
                            this.loading = false;
                        },
                    });
                } else {
                    this.loading = false;
                }
            });
        },
    },
};
</script>
