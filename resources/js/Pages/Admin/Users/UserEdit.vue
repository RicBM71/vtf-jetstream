<template>
    <app-layout :input_loading.sync="input_loading">

        <template #header>
            <h2>Usuarios</h2>
            <v-spacer></v-spacer>
            <menuope
                :id="user.id"
                :input_loading.sync="input_loading"
            ></menuope>
        </template>
        <v-container>
            <v-card>
                <v-card-title color="indigo">
                </v-card-title>
                <v-tabs fixed-tabs>
                <v-tab>
                        Datos generales
                </v-tab>
                 <v-tab>
                        Roles y Permisos
                </v-tab>
                <v-tab-item>

                    <v-col cols="12" md="7">
                        <update-user-information :user="user" />
                        <br/>
                    </v-col>

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
export default {
    components: {
        AppLayout,
        Menuope,
        UpdateUserInformation,
    },
    data() {
        return {
            input_loading: false,
        };
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    mounted() {
        console.log(this.getUltUrl);
    },
    methods: {
        openDialog(){

        },
    },
};
</script>
