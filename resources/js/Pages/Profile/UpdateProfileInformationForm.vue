<template>
  <form-card
    :handleSubmit="updateProfileInformation"
    :message="message"
  >
    <template #title>
      <h3>Perfil de usuario</h3>
    </template>

    <template #subtitle>
      Actualiza tu cuenta de usuario, email...
    </template>

    <!-- Profile Photo -->
    <template v-if="$page.props.jetstream.managesProfilePhotos">
      <!-- Profile Photo File Input -->
      <input type="file" class="d-none" ref="photo" @change="updatePhotoPreview">

      <!-- Current Profile Photo -->
      <div v-show="!photoPreview">
        <v-avatar size="84">
          <img :src="user.profile_photo_url" alt="Current Profile Photo">
        </v-avatar>
      </div>

      <!-- New Profile Photo Preview -->
      <div v-show="photoPreview">
        <v-avatar size="84">
          <img :src="photoPreview" alt="New Profile Photo">
        </v-avatar>
      </div>

      <v-btn
        class="mt-5 mr-2"
        x-small
        @click.native.prevent="selectNewPhoto"
      >
        Seleccionar Avatar
      </v-btn>

      <v-btn
        v-if="user.profile_photo_path"
        x-small
        class="mt-5"
        color="warning"
        @click.native.prevent="deletePhoto"
      >
        Borrar Avatar
      </v-btn>
    </template>

    <!-- First Name -->
    <v-text-field
      outlined
      autocomplete="given-name"
      label="Nombre"
      v-model="form.name"
      class="mt-8"
    ></v-text-field>

    <!-- Last Name -->
    <v-text-field
      outlined
      autocomplete="family-name"
      label="Apellidos"
      v-model="form.lastname"
    ></v-text-field>

    <!-- Email -->
    <v-text-field
      outlined
      autocomplete="email"
      label="Email"
      v-model="form.email"
    ></v-text-field>
  </form-card>
</template>

<script>
import FormCard from '../../Components/FormCard'

export default {
  components: {
    FormCard
  },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    name: this.user.name,
                    lastname: this.user.lastname,
                    email: this.user.email,
                    photo: null,
                }),

                photoPreview: null,
            }
        },

        computed: {
            message () {
            return {
                show: this.form.recentlySuccessful,
                text: 'Guardado',
                type: 'success'
            }
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post(route('user-profile-information.update'), {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.photo.files[0]);
            },

            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => (this.photoPreview = null),
                });
            },
        },
    }
</script>
