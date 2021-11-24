<template>
    <div>
        <my-dialog :dialog.sync="dialog" @destroyReg="destroyReg"></my-dialog>
        <toast
            :snackbar.sync="snackbar"
            :message="snack_message"
            :data="response"
        ></toast>


            <v-toolbar dense elevation="1">
            <h2>Usuarios</h2>
            <v-spacer></v-spacer>
            <menuope></menuope>
            </v-toolbar>

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
                <template v-slot:item.login_at="{ item }">
                    {{ getFechaHora(item.login_at)}}
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
            <div class="text-center">
                <v-pagination
                    v-model="current_page"
                    :length="last_page"
                    :total-visible="5"
                    circle
                ></v-pagination>
            </div>
        </v-container>
    </div>
</template>

<script>

import Menuope from "./Menuope";
import MyDialog from "@/Shared/MyDialog";
import Toast from "@/Shared/Toast";


export default {
    layout: null,
    props: {
        paginator: {
            type: Object,
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
            current_page: 0,
            last_page: 0,
            dialog: false,
            editedIndex: -1,
            headers: [
                { text: "A", value: "id" },
                {
                    text: "Username",
                    align: "start",
                    value: "username",
                },
                {
                    text: "Nombre",
                    align: "start",
                    value: "name",
                },
                {
                    text: "Apellidos",
                    align: "start",
                    value: "lastname",
                },
                { text: "Login", value: "login_at" },
                { text: "Email", value: "email" },
                { text: "UM", value: "huella" },
                { text: "Acciones", value: "actions" },
            ],
        };
    },
    mounted() {
        console.log(this.$page.props.errors);
        if (this.$page.props.errors.message != null){
            this.response = this.$page.props.errors;
            this.snackbar = true;
        }

        this.current_page = this.paginator.current_page;
        this.last_page = this.paginator.last_page;

        this.loading = false;

    },
    watch: {
        current_page(new_val) {
            if (new_val != this.paginator.current_page) {
                this.setMyHistoryUrl();
                this.$inertia.get("users", { page: new_val });
            }
        },
    },
    methods: {
        editItem(item) {

            this.setMyHistoryUrl();

            this.$inertia.get(route("users.edit", { user: item.id }));
        },
        openDialog(item) {
            this.dialog = true;
            this.item = item;
        },
        doThing(){

            console.log("pasa");
        },
        destroyReg() {
            this.editedIndex = this.paginator.data.indexOf(this.item);
            //this.dialog = false;
            this.$inertia.delete(route("users.destroy", {user: this.item.id}), {
                onSuccess: () => {
                    return Promise.all([
                        this.doThing('errir'),
                ])},
                //     this.paginator.data.splice(this.editedIndex, 1);

                onError: () => {
                    //this.$toast/(this.$page.props.errors);
                    this.response = this.$page.props.errors;
                    this.snackbar = true;
                },
                onFinish: () => this.input_loading = false,
            });
            // this.input_loading = false;

            // console.log("destory");

            // axios.post("/admin/users/" + this.item.id, {
            //         _method: "delete",
            //     })
            //     .then((res) => {
            //         console.log(res);
            //         this.paginator.data.splice(this.editedIndex, 1);
            //         this.response = res.data;
            //         this.snackbar = true;
            //     })
            //     .catch((err) => {
            //         this.response = err.response.data;
            //         this.snackbar = true;
            //     })
            //     .finally(()=> {
            //     });
        },
    },
};
</script>
