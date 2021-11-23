<template>
    <v-navigation-drawer
        v-model="drawer"
        :clipped="$vuetify.breakpoint.lgAndUp"
        app
    >
        <v-list dense>
            <template v-for="item in items">
                <v-row v-if="item.heading" :key="item.heading" align="center">
                    <v-col cols="6">
                        <v-subheader v-if="item.heading">
                            {{ item.heading }}
                        </v-subheader>
                    </v-col>
                    <v-col cols="6" class="text-center">
                        <a href="#!" class="body-2 black--text">EDIT</a>
                    </v-col>
                </v-row>
                <v-list-group
                    v-else-if="item.children"
                    :key="item.text"
                    v-model="item.model"
                    :prepend-icon="item.model ? item.icon : item['icon-alt']"
                >
                    <template v-slot:activator>
                        <v-list-item-content>
                            <v-list-item-title>
                                {{ item.text }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </template>
                    <v-list-item
                        v-for="(child, i) in item.children"
                        :key="i"
                        link
                    >
                        <v-list-item-action v-if="child.icon">
                            <v-icon>{{ child.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content @click="abrir(child.name)">
                            <v-list-item-title>
                                {{ child.text }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-group>
                <v-list-item v-else :key="item.text" link>
                    <v-list-item-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content @click="abrir(item.name)">
                        <v-list-item-title>
                            {{ item.text }}
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    props: {
        drawer: Boolean,
    },
    data: () => ({
        items: [
            { icon: "mdi-contacts", text: "Pacientes", name: "paciente.index" },
            {
                icon: "mdi-account-tie-outline",
                text: "Facultativos",
                name: "facultativo.index",
            },
            { icon: "mdi-calendar", text: "Bloqueos", name: "bloqueo.index" },
            {
                icon: "mdi-chevron-up",
                "icon-alt": "mdi-chevron-down",
                text: "Mantenimientos",
                model: false,
                children: [
                    { icon: "mdi-plus", text: "Areas", name: "area.index" },
                    { icon: "mdi-plus", text: "Caja", name: "caja.index" },
                    { icon: "mdi-plus", text: "Cuentas", name: "cuenta.index" },
                    { icon: "mdi-plus", text: "Bonos", name: "bono.index" },
                    {
                        icon: "mdi-plus",
                        text: "Tratamientos",
                        name: "tratamiento.index",
                    },
                    {
                        icon: "mdi-plus",
                        text: "Sociedades",
                        name: "mutua.index",
                    },
                    {
                        icon: "mdi-plus",
                        text: "Tipos de IVA",
                        name: "iva.index",
                    },
                ],
            },
            {
                icon: "mdi-chevron-up",
                "icon-alt": "mdi-chevron-down",
                text: "Consultas",
                model: false,
                children: [
                    {
                        icon: "mdi-plus",
                        text: "Cobros Año/Mes",
                        name: "cobrosmes.index",
                    },
                    {
                        icon: "mdi-plus",
                        text: "Comparativo Mes",
                        name: "comparativo.index",
                    },
                ],
            },
            {
                icon: "mdi-chevron-up",
                "icon-alt": "mdi-chevron-down",
                text: "Procesos",
                model: false,
                children: [
                    {
                        icon: "mdi-circle-medium",
                        text: "Facturación",
                        name: "facturacion.index",
                    },
                ],
            },
            {
                icon: "mdi-cog",
                "icon-alt": "mdi-cog",
                text: "Configuración",
                model: false,
                children: [
                    {
                        icon: "mdi-circle-medium",
                        text: "Usuarios",
                        name: "users.index",
                    },
                    {
                        icon: "mdi-circle-medium",
                        text: "Roles",
                        name: "roles.index",
                    },
                    {
                        icon: "mdi-circle-medium",
                        text: "Festivos",
                        name: "festivo.index",
                    },
                    {
                        icon: "mdi-circle-medium",
                        text: "Parametros",
                        name: "parametros.index",
                    },
                ],
            },
        ],
        mn_root: {
            icon: "mdi-chevron-up",
            "icon-alt": "mdi-chevron-down",
            text: "Root",
            model: false,
            children: [
                { icon: "mdi-plus", text: "Roles", name: "roles.index" },
            ],
        },
    }),
    mounted() {
      //  console.log(this.items);
    },
    methods: {
        abrir(name) {
            //this.drawer = false;
            this.ressetMyHistoryUrl();
            this.show_loading = true;
            this.$inertia.get(route(name));
        },
    },
};
</script>
