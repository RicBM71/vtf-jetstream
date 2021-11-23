<template>
    <div>
        <my-dialog :dialog.sync="dialog" @destroyReg="destroyReg"></my-dialog>
        <toast
            :snackbar.sync="snackbar"
            :message="snack_message"
            :data="response"
        ></toast>


            <v-toolbar dense elevation="1">
            <h2>Roles</h2>
            <v-spacer></v-spacer>
            <menuope></menuope>
            </v-toolbar>

        <v-container>
            <v-data-table
                :headers="headers"
                :items="items"
                :items-per-page="10"
                class="elevation-1"
                :loading="loading"
            >

                <template v-slot:item.permissions="{ item }">
                    {{ getPermisos(item.permissions)}}
                </template>
                <template v-slot:item.updated_at="{ item }">
                    {{ getFechaHora(item.updated_at)}}
                </template>
                <template v-slot:[`item.actions`]="{ item }">
                    <v-icon
                        small
                        color="black"
                        @click="editItem(item)"
                    > mdi-pencil </v-icon>
                    <v-icon
                        :disabled="!hasRole('root')"
                        small
                        color="red darken-4"
                        @click="openDialog(item)"
                    >
                        mdi-delete
                    </v-icon>
                </template>
            </v-data-table>
        </v-container>

    </div>
</template>

<script>

import Menuope from "./Menuope";
import MyDialog from "@/Layouts/MyDialog";
import Toast from "@/Layouts/Toast";


export default {
    layout: null,
    props: {
        items: {
            type: Array,
            required: true,
        },
    },
    components: {

        Menuope,
        MyDialog,
        Toast,
    },
    data() {
        return {
            response: { message: "", status: 200 },
            snack_message: "",
            snackbar: false,
            item: {},
            loading: true,

            roles: [],
            dialog: false,
            editedIndex: -1,
            headers: [
                {
                    text: "Role",
                    align: "start",
                    value: "name",
                },
                { text: "Permisos", value: "permissions", sortable: false },
                { text: "UM", value: "updated_at" },
                { text: "Acciones", value: "actions" },
            ],
        };
    },
    beforeMount(){
        this.roles = this.items;
    },
    mounted() {
        this.loading = false;
        //console.log(this.roles);
    },
    methods: {
        getPermisos(item){
            return _.replace(_.toString(_.map(item, 'nombre')),',',', ');
        },
        editItem(item) {
            this.setMyHistoryUrl();

            this.$inertia.get(route("roles.edit", { role: item.id }));
        },
        openDialog(item) {
            this.dialog = true;
            this.item = item;
        },
        destroyReg() {
            //this.dialog = false;

            // this.$inertia.delete(route("users.destroy", {user: this.item.id}), {
            //     onSuccess: () => {
            //          this.items.splice(this.editedIndex, 1);
            //         },
            //     onError: () => {
            //         return Promise.all([
            //             this.doThing('errir'),
            //             ])},
            //     onFinish: () => this.input_loading = false,
            // });
            // this.input_loading = false;
            this.editedIndex = this.items.indexOf(this.item);

            // console.log("destory");

            axios.post("/dashboard/admin/users/" + this.item.id, {
                    _method: "delete",
                })
                .then((res) => {
                    this.items.splice(this.editedIndex, 1);
                    this.response = res.data;
                    this.snackbar = true;
                })
                .catch((err) => {
                    this.response = err.response.data;
                    this.snackbar = true;
                })
                .finally(()=> {

                });
        },
    },
};
</script>
