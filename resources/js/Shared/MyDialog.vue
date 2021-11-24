<template>

    <v-dialog v-model="dialog" persistent max-width="420">
        <v-card>
            <v-card-title class="headline">Aviso</v-card-title>
            <v-card-text>{{message}}</v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text rounded @click="closeDialog()">Cancelar</v-btn>
            <v-btn color="blue darken-1" text rounded @click="deleteItem">Aceptar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</template>

<script>

export default {
    props:{
        dialog: {
            type: Boolean,
            default: false,
        },
        message:{
            type: String,
            default: "¿Desea borrar el registro seleccionado?"
        }

    },
    components: {
    },
    data() {
        return {};
    },
    mounted() {

    },
    methods:{
        closeDialog (){
            this.$emit('update:dialog', false)
        },
        deleteItem () {
            this.$emit('destroyReg');
            this.$emit('update:dialog', false);
        }
      }
};
</script>
