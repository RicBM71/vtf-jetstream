<template>
    <v-card>
        <v-card-title class="overline">
            <h3>Profile Information</h3>
        </v-card-title>

        <v-form @submit.prevent="update">
            <v-card-text class="py-0">
                <v-row>
                    <v-col cols="12" md="5">
                        <template
                            v-if="$page.props.jetstream.managesProfilePhotos"
                        >
                            <!-- Profile Photo File Input -->
                            <input
                                type="file"
                                class="d-none"
                                ref="photo"
                                @change="updatePhotoPreview"
                            />

                            <!-- Current Profile Photo -->
                            <div v-show="!photoPreview">
                                <v-avatar size="84">
                                    <img
                                        :src="user.profile_photo_url"
                                        alt="Current Profile Photo"
                                    />
                                </v-avatar>
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div v-show="photoPreview">
                                <v-avatar size="84">
                                    <img
                                        :src="photoPreview"
                                        alt="New Profile Photo"
                                    />
                                </v-avatar>
                            </div>

                            <v-btn
                                class="mt-5 mr-2"
                                x-small
                                @click.native.prevent="selectNewPhoto"
                            >
                                Select A New Photo
                            </v-btn>

                            <v-btn
                                v-if="user.profile_photo_path"
                                x-small
                                :loading="loading_photo"
                                class="mt-5"
                                color="warning"
                                @click.native.prevent="deletePhoto"
                            >
                                Remove Photo
                            </v-btn>
                        </template>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            label="First Name"
                            dense
                            v-model="form.name"
                            v-validate="'required|min:3'"
                            :error-messages="errors.collect('name')"
                            data-vv-name="name"
                            data-vv-as="name"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            label="Last Name"
                            dense
                            v-model="form.last_name"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            label="Email"
                            dense
                            v-model="form.email"
                            v-validate="'required|email'"
                            :error-messages="errors.collect('email')"
                            data-vv-name="email"
                            data-vv-as="email"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            readonly
                            dense
                            v-model="computedHuella"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="3" offset-md="9">
                        <v-btn block small type="submit" :loading="loading">
                            Save
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-form>
    </v-card>
</template>

<script>
import FormCard from "../../../Components/FormCard";

export default {
    components: {
        FormCard,
    },

    props: ["user"],

    data() {
        return {
            form: this.$inertia.form({
                _method: "PUT",
                name: this.user.name,
                email: this.user.email,
                photo: null,
            }),

            photoPreview: null,
            loading: false,
            loading_photo: false,
        };
    },

    computed: {
        computedHuella() {

            return (
                "admin.rbm " +
                this.$moment(this.user.updated_at).format("D/MM/YYYY H:mm:ss") +
                " # Creado: " +
                this.$moment(this.user.created_at).format("D/MM/YYYY")
            );
        },
    },

    methods: {
        update() {
            this.loading = true;
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0];
            }

            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.form.post(route("users.update", { user: this.user }), {
                        errorBag: "updateProfileInformation",
                        preserveScroll: true,
                        onFinish: () => {
                            const msg_valid = this.form.errors;
                            for (const prop in msg_valid) {
                                this.errors.add({
                                    field: prop,
                                    msg: `${msg_valid[prop]}`,
                                });
                            }
                            this.loading = false;
                        },
                    });
                } else {
                    this.loading = false;
                }
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
            this.loading_photo = true;
            this.$inertia.delete(route("photo.destroy", { user: this.user }), {
                preserveScroll: true,
                onSuccess: () => (this.photoPreview = null),
                onFinish: () => (this.loading_photo = false),
            });
        },
    },
};
</script>
