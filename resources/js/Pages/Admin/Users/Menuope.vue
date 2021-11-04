<template>
    <div class="d-flex">
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn
                    class="mr-1"
                    v-show="computedAdd"
                    v-on="on"
                    x-small
                    @click="goCreate"
                >
                    Nuevo
                </v-btn>
            </template>
            <span>Crear un nuevo registro</span>
        </v-tooltip>
        <v-tooltip bottom v-if="id > 0">
            <template v-slot:activator="{ on }">
                <v-btn
                    class="mr-1"
                    v-on="on"
                    x-small
                    @click="openDialog"
                >
                    Borrar
                </v-btn>
            </template>
            <span>Borrar Registro actual</span>
        </v-tooltip>
        <v-tooltip bottom v-if="id > 0">
            <template v-slot:activator="{ on }">
                <v-btn class="mr-1"
                     v-on="on" x-small @click="goIndex">
                    Lista
                </v-btn>
            </template>
            <span>Volver a la lista de resultados</span>
        </v-tooltip>

        <v-btn class="mr-1" x-small @click="goBack">
            Volver
        </v-btn>


    </div>
</template>
<script>
export default {
    props:{
        id: {
            type: Number,
            default: 0,
        },
        input_loading: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        computedAdd() {
            return true;
        },
    },
    methods: {
        goCreate() {

        },
        goIndex() {

        },
        goBack() {
            this.$emit('update:input_loading', true);
            console.log(this.input_loading);
            window.history.back();
        },
    },
};
</script>
