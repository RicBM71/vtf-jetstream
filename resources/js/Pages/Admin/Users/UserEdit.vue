<template>
    <app-layout :input_loading.sync="input_loading">
        <template #header>
            <h2>Usuarios</h2>
            <v-spacer></v-spacer>
            <menuope
                :id="usuario.id"
                :input_loading.sync="input_loading"
            ></menuope>
        </template>
        <v-container>
            <v-card>
                <v-card-title color="indigo"> </v-card-title>
                <v-tabs fixed-tabs>
                    <v-tab> Datos generales </v-tab>
                    <v-tab> Empresas </v-tab>
                    <v-tab-item>
                        <v-row>
                            <v-col cols="12" md="7">
                                <update-user-information :user="usuario" />
                            </v-col>

                            <v-col cols="12" md="5">
                                <user-roles :user_id="usuario.id"></user-roles>
                            </v-col>
                        </v-row>
                    </v-tab-item>
                </v-tabs>
            </v-card>
        </v-container>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import Menuope from "./Menuope";
import UpdateUserInformation from "./UpdateUserInformation";
import UserRoles from "./UserRoles";

export default {
    components: {
        AppLayout,
        Menuope,
        UpdateUserInformation,
        UserRoles,
    },
    data() {
        return {
            input_loading: false,
        };
    },
    props: {
        usuario: {
            type: Object,
            required: true,
        },
    },
    mounted() {},
    methods: {
        openDialog() {},
    },
};
</script>
