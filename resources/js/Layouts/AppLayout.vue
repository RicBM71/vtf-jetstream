<template>
    <v-app id="inspire">
        <navigation-drawer :drawer.sync="drawer"></navigation-drawer>

        <auth-app-bar :drawer.sync="drawer"></auth-app-bar>

        <v-main class="grey lighten-4">
            <v-container id="container">
                <!-- Headings -->
                <!-- <headings :hasTitle="hasTitle" :hasSubtitle="hasSubtitle">
                    <template v-if="hasTitle" #title>
                        <slot name="title"></slot>
                    </template>
                    <template v-if="hasSubtitle" #subtitle>
                        <slot name="subtitle"></slot>
                    </template>
                </headings> -->


                <slot></slot>
            </v-container>
        </v-main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple></portal-target>
    </v-app>
</template>

<script>
import AuthAppBar from "@/Components/Layout/AuthAppBar";
import Headings from "@/Components/Headings";
import NavigationDrawer from "@/Components/Layout/NavigationDrawer";

export default {
    components: {
        AuthAppBar,
        Headings,
        NavigationDrawer,
    },

    data() {
        return {
            showingNavigationDropdown: false,
            drawer: false,
        };
    },

    computed: {
        hasTitle() {
            return !!this.$slots.title;
        },

        hasSubtitle() {
            return !!this.$slots.subtitle;
        },
    },

    watch: {
        drawer(val) {
            return val;
        },
    },

    methods: {
        logout() {
            axios.post(route("logout").url()).then((response) => {
                window.location = "/";
            });
        },
    },
};
</script>
