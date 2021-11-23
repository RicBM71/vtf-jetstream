<template>
    <div>
        <my-dialog :dialog.sync="dialog" @destroyReg="destroyReg"></my-dialog>
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn
                    class="mr-1"
                    v-show="computedAdd"
                    v-on="on"
                    small
                    icon
                    @click="goCreate"
                >
                    <v-icon color="primary">mdi-plus</v-icon>
                </v-btn>
            </template>
            <span>Crear un nuevo registro</span>
        </v-tooltip>
        <v-tooltip bottom v-if="id > 0">
            <template v-slot:activator="{ on }">
                <v-btn
                    :disabled="!hasRole('root')"
                    class="mr-1"
                    v-on="on"
                    small
                    icon
                    color="red darken-4"
                    @click="openDialog"
                >
                    <v-icon>mdi-delete</v-icon>
                </v-btn>
            </template>
            <span>Borrar Registro actual</span>
        </v-tooltip>
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn class="mr-1" v-on="on" small icon @click="goRoles">
                    <v-icon color="primary">mdi-hammer-screwdriver</v-icon>
                </v-btn>
            </template>
            <span>Roles</span>
        </v-tooltip>
        <v-tooltip bottom v-if="id > 0">
            <template v-slot:activator="{ on }">
                <v-btn class="mr-1" v-on="on" icon small @click="goIndex">
                    <v-icon color="primary">mdi-format-list-bulleted</v-icon>
                </v-btn>
            </template>
            <span>Volver a la lista de resultados</span>
        </v-tooltip>
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn class="mr-1" v-on="on" small icon @click="goBack">
                    <v-icon color="primary">mdi-subdirectory-arrow-left</v-icon>
                </v-btn>
            </template>
            <span>Volver</span>
        </v-tooltip>
    </div>
</template>
<script>
import MyDialog from "@/Layouts/MyDialog";
export default {
    props: {
        id: {
            type: Number,
            default: 0,
        }
    },
    components: {
        MyDialog,
    },
    data() {
        return {
            dialog: false,
        };
    },
    mounted() {},
    computed: {
        computedAdd() {
            return true;
        },
    },
    methods: {
        goCreate() {
            this.setMyHistoryUrl();
            this.$inertia.get(route("users.create"));
        },
        goRoles() {
            this.setMyHistoryUrl();
            this.$inertia.get(route("roles.index"));
        },
        goIndex() {
            this.$inertia.get(route("users.index"));
        },
        openDialog() {
            this.dialog = true;
        },
        destroyReg() {
            this.$inertia.delete(route("users.destroy", {user: this.id}), {
                onError: () => {
                    this.response = this.$page.props.errors;
                    this.snackbar = true;
                }
            });

            // axios
            //     .post("/admin/users/" + this.id, {
            //         _method: "delete",
            //     })
            //     .then((res) => {
            //         this.response = res.data;
            //         this.snackbar = true;
            //     })
            //     .catch((err) => {
            //         this.response = err.response.data;
            //         this.snackbar = true;
            //     })
            //     .finally(() => {
            //         this.goBackUrl();
            //     });
        },
        goBack() {
            this.goBackUrl();
        },
    },
};
</script>
