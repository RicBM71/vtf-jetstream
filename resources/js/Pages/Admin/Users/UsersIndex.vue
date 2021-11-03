<template>
    <app-layout>
        <template #header>
            <h2>Users</h2>
        </template>
        <v-container>

            <v-data-table
                :headers="headers"
                :items="paginator.data"
                :items-per-page="10"
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
import AppLayout from "@/Layouts/AppLayout";

export default {
    props:{
        paginator: {
            type: Object,
            required: true
        }
    },
    components: {
        AppLayout,
    },
     data () {
      return {
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
        ],
      }
    },
    mounted(){

        this.current_page = this.paginator.current_page;
        this.last_page = this.paginator.last_page;

    },
    watch:{

        current_page(new_val){
            if (new_val != this.paginator.current_page)
                this.$inertia.get('users', {page: new_val})
        }

    }

};
</script>
