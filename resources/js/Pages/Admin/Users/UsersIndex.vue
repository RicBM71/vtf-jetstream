<template>
    <app-layout :input_loading.sync="input_loading">
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
            <template v-slot:item.id="{ item }">
               <v-avatar size="32px">
                    <img
                        class="img-fluid"
                        :src="item.profile_photo_url"
                        :alt="item.name"
                    />
                </v-avatar>
                </template>
                <template v-slot:item.actions="{ item }">
                        <v-icon
                            small

                            @click="editItem(item.id)"
                        >
                            mdi-pencil
                        </v-icon>
                        <v-icon
                            small
                            color="red darken-4"
                            @click="openDialog(item.id)"
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


import Auth from "@/Mixins/Auth";

import AppLayout from "@/Layouts/AppLayout";
import Menuope from "./Menuope";

export default {
    props:{
        paginator: {
            type: Object,
            required: true
        }
    },
    components: {
        AppLayout,
        Menuope
    },
    mixins:[Auth],
     data () {
      return {
        loading: true,
        input_loading: false,
        current_page: 0,
        last_page: 0,
        headers: [
            { text: 'A', value: 'id' },
          {
            text: 'Name',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'Email', value: 'email' },
          { text: 'Creado', value: 'created_at' },
          { text: 'Acciones', value: 'actions'}
        ],
      }
    },
    mounted(){

        this.current_page = this.paginator.current_page;
        this.last_page = this.paginator.last_page;

        this.loading = false;
        

    },
    watch:{

        current_page(new_val){
            if (new_val != this.paginator.current_page){
                this.loading = true;
                this.$inertia.get('users', {page: new_val})
            }
        }

    },
    methods:{
        editItem(id){
            this.input_loading = true;
            this.$inertia.get(route('users.edit', {user: id}));
        }
    }
};
</script>
