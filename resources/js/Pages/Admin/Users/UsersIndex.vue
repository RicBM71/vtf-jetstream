<template>
    <app-layout :input_loading.sync="input_loading">
        <my-dialog :dialog.sync="dialog" @destroyReg="destroyReg"></my-dialog>
        <toast
            :snackbar.sync="snackbar"
            :message="snack_message"
            :data="response"
        ></toast>

        <template #header>
            <h2>Users</h2>
            <v-spacer></v-spacer>
            <menuope :input_loading.sync="input_loading"></menuope>
        </template>
        <v-container>
            <v-data-table
                :headers="headers"
                :items="paginator.data"
                :items-per-page="10"
                class="elevation-1"
                :loading="loading"
                loading-text="Loading... Please wait"
            >
                <template v-slot:[`item.id`]="{ item }">
                    <v-avatar size="32px">
                        <img
                            class="img-fluid"
                            :src="item.profile_photo_url"
                            :alt="item.name"
                        />
                    </v-avatar>
                </template>
                <template v-slot:[`item.actions`]="{ item }">
                    <v-icon small @click="editItem(item)"> mdi-pencil </v-icon>
                    <v-icon
                        small
                        color="red darken-4"
                        @click="openDialog(item)"
                    >
                        mdi-delete
                    </v-icon>
                </template>
            </v-data-table>
            <div class="text-center">
                <v-pagination
                    v-model="current_page"
                    :length="last_page"
                    :total-visible="5"
                    circle
                ></v-pagination>
            </div>
        </v-container>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Menuope from "./Menuope";
import MyDialog from "@/Layouts/MyDialog";
import Toast from "@/Layouts/Toast";

export default {
    props: {
        paginator: {
            type: Object,
            required: true,
        },
    },
    components: {
        AppLayout,
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
            input_loading: false,
            current_page: 0,
            last_page: 0,
            dialog: false,
            editedIndex: -1,
            headers: [
                { text: "A", value: "id" },
                {
                    text: "Name",
                    align: "start",
                    sortable: false,
                    value: "name",
                },
                { text: "Email", value: "email" },
                { text: "Creado", value: "created_at" },
                { text: "Acciones", value: "actions" },
            ],
        };
    },
    mounted() {
        this.current_page = this.paginator.current_page;
        this.last_page = this.paginator.last_page;

        this.loading = false;
    },
    watch: {
        current_page(new_val) {
            if (new_val != this.paginator.current_page) {
                this.loading = true;
                this.$inertia.get("users", { page: new_val });
            }
        },
    },
    methods: {
        editItem(item) {
            this.input_loading = true;
            this.$inertia.get(route("users.edit", { user: item.id }));
        },
        openDialog(item) {
            this.dialog = true;
            this.item = item;
        },
        doThing(x){
            alert(x);
        },
        destroyReg() {
            //this.dialog = false;
            this.input_loading = true;
            // this.$inertia.delete(route("users.destroy", {user: this.item.id}), {
            //     onSuccess: () => {
            //          this.paginator.data.splice(this.editedIndex, 1);
            //         },
            //     onError: () => {
            //         return Promise.all([
            //             this.doThing('errir'),
            //             ])},
            //     onFinish: () => this.input_loading = false,
            // });
            // this.input_loading = false;
            this.editedIndex = this.paginator.data.indexOf(this.item);

            // console.log("destory");

            axios.post("/dashboard/admin/users/" + this.item.id, {
                    _method: "delete",
                })
                .then((res) => {
                    this.paginator.data.splice(this.editedIndex, 1);
                    this.response = res.data;
                    this.snackbar = true;
                })
                .catch((err) => {
                    this.response = err.response.data;
                    this.snackbar = true;
                })
                .finally(()=> {
                    this.input_loading = false;
                });
        },
    },
};
</script>
