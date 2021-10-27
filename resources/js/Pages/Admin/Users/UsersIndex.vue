<template>
    <app-layout>
        <template #header>
            <h2>Users</h2>
        </template>
        <v-container>

            <v-data-table
                :headers="headers"
                :items="users"
                :items-per-page="5"
                class="elevation-1"
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
            </v-data-table>

        </v-container>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    props:{
        users: {
            type: Array,
            required: true
        }
    },
    components: {
        AppLayout,
    },
     data () {
      return {
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
        ],
      }
    }
};
</script>
