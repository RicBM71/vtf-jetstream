<template>
    <v-card class="my-6 mr-4">
        <v-card-title class="overline">
            <h3>Permisos</h3>
        </v-card-title>
        <v-card-text class="py-0">
            <v-row>
                <v-col
                    v-for="permiso in permisos"
                    :key="permiso.name"
                    cols="12"
                    md="4"
                >
                    <v-switch
                        v-model="permisos_usr"
                        :label="permiso.nombre"
                        :value="permiso.name"
                        :disabled="desactivar(permiso)"
                        color="primary"
                    >
                    </v-switch>
                </v-col>
                <v-col
                    v-if="permisos.length > 0"
                    cols="12"
                    offset-md="10"
                    md="2"
                >
                    <v-btn @click="setUserPermiso" small :loading="loading">
                        Guardar
                    </v-btn>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>
<script>
export default {
    components: {},
    data() {
        return {
            permisos: [],
            loading: false,
        };
    },
    props: {
        user_id: {
            type: Number,
            required: true,
        },
        permisos_heredados: {
            type: Array,
            required: true,
        },
        permisos_usr: {
            type: Array,
            required: true,
        },
    },
    mounted() {
        axios
            .get("/admin/users/" + this.user_id + "/permission")
            .then((res) => {
                this.permisos = res.data.permisos;
            })
            .catch((err) => {
                console.log(err.response);
            });
    },
    methods: {
        desactivar(item) {
            if (this.permisos_heredados.length == 0) return false;
            return this.permisos_heredados.findIndex(
                (element) => element === item.name
            ) >= 0
                ? true
                : false;
        },
        setUserPermiso() {
            this.loading = true;
            axios
                .put("/admin/users/" + this.user_id + "/permission", {
                    permisos: this.permisos_usr,
                })
                .then((res) => {
                    this.permisos_heredados = res.data.permisos_heredados;
                    this.permisos_usr = res.data.permisos_usr;
                })
                .catch((err) => {
                    console.log(err.response);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>
