<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            :clipped="$vuetify.breakpoint.lgAndUp"
            app
        >
        <v-list dense>
            <template v-for="item in items">
            <v-row
                v-if="item.heading"
                :key="item.heading"
                align="center"
            >
                <v-col cols="6">
                <v-subheader v-if="item.heading">
                    {{ item.heading }}
                </v-subheader>
                </v-col>
                <v-col
                cols="6"
                class="text-center"
                >
                <a
                    href="#!"
                    class="body-2 black--text"
                >EDIT</a>
                </v-col>
            </v-row>
            <v-list-group
                v-else-if="item.children"
                :key="item.text"
                v-model="item.model"
                :prepend-icon="item.model ? item.icon : item['icon-alt']"
                append-icon=""
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
            <v-list-item
                v-else
                :key="item.text"
                link
            >
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

        <v-app-bar
        dense
        :clipped-left="$vuetify.breakpoint.lgAndUp"
        app
        :color="bar_color"
        dark
        >
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
        <v-toolbar-title
            style="width: 300px"
            class="ml-0 pl-4"
        >
            <span class="hidden-sm-and-down">{{empresa_nombre}}</span>
        </v-toolbar-title>
        <v-spacer />




        <inertia-link v-if="currentRoute" :href="route('dashboard')">
            <v-btn icon>
                <v-icon>mdi-home</v-icon>
            </v-btn>
        </inertia-link>

        <v-btn @click="profile()" icon v-if="$page.props.jetstream.managesProfilePhotos">
            <v-avatar size="32px">
                <img class="img-fluid" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
            </v-avatar>
        </v-btn>

        <v-btn icon @click="Logout">
            <v-avatar size="32px" tile>
                <v-icon>mdi-exit-to-app</v-icon>
            </v-avatar>
        </v-btn>

        </v-app-bar>


        <v-main>


            <!-- Page Heading -->
            <header v-if="$slots.header">
                <div class="my-4 mx-10">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>

            <!-- Modal Portal -->
            <portal-target name="modal" multiple>
            </portal-target>



        </v-main>

    </v-app>
</template>
<script>
export default {
    components: {
    },
    computed:{
        currentRoute(){
            return !(window.location.pathname == '/dashboard');
        }
    },
    data: () => ({
        empresa_nombre:'Test Inertia',
        menu: true,
        drawer: false,
        show: true,
        user:{},

        bar_color: 'blue darken-3',

        items: [
            { icon: 'mdi-contacts', text: 'Pacientes', name: 'paciente.index' },
            { icon: 'mdi-account-tie-outline', text: 'Facultativos', name: 'facultativo.index' },
            { icon: 'mdi-calendar', text: 'Bloqueos', name: 'bloqueo.index' },
            {
            icon: 'mdi-chevron-up',
            'icon-alt': 'mdi-chevron-down',
            text: 'Mantenimmientos',
            model: false,
            children: [
                { icon: 'mdi-plus', text: 'Areas', name:'area.index'  },
                { icon: 'mdi-plus', text: 'Caja', name:'caja.index'  },
                { icon: 'mdi-plus', text: 'Cuentas', name:'cuenta.index'  },
                { icon: 'mdi-plus', text: 'Bonos', name:'bono.index' },
                { icon: 'mdi-plus', text: 'Tratamientos', name:'tratamiento.index'  },
                { icon: 'mdi-plus', text: 'Sociedades', name:'mutua.index'  },
                { icon: 'mdi-plus', text: 'Tipos de IVA', name:'iva.index'  },
            ],
            },
            {
            icon: 'mdi-chevron-up',
            'icon-alt': 'mdi-chevron-down',
            text: 'Consultas',
            model: false,
            children: [
                { icon: 'mdi-plus', text: 'Cobros Año/Mes', name: 'cobrosmes.index' },
                { icon: 'mdi-plus', text: 'Comparativo Mes', name: 'comparativo.index' },
            ],
            },
            {
            icon: 'mdi-chevron-up',
            'icon-alt': 'mdi-chevron-down',
            text: 'Procesos',
            model: false,
            children: [
                { icon: 'mdi-circle-medium', text: 'Facturación', name: 'facturacion.index' },
            ],
            },
            {
            icon: 'mdi-chevron-up',
            'icon-alt': 'mdi-chevron-down',
            text: 'Administración',
            model: false,
            children: [
                { icon: 'mdi-circle-medium', text: 'Empresas', name: 'empresa.index' },
                { icon: 'mdi-circle-medium', text: 'Usuarios', name: 'users.index' },
                { icon: 'mdi-circle-medium', text: 'Festivos', name: 'festivo.index' },
                { icon: 'mdi-circle-medium', text: 'Parametros', name: 'parametros.index' },
            ],
            },

        ],
        mn_root:{
            icon: 'mdi-chevron-up',
            'icon-alt': 'mdi-chevron-down',
            text: 'Root',
            model: false,
            children: [
                { icon: 'mdi-plus', text: 'Roles', name:'roles.index'  },
            ],
            },

        expired: false,
        objetivo: 0,
    }),
    mounted(){

        console.log(window.location.pathname);

    },

    methods:{

        abrir(name){
            //console.log(name);
            //this.drawer = false;
            this.$intertia.get({name: name});
        },
        home(){
        },
        profile(){
            this.$inertia.get(route('profile.show'));
        },
        Logout() {
            //this.$toast.success('Logout, espere...');
            this.$inertia.post(route('logout'));

        },
    }
  }
</script>
