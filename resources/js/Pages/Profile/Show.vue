<template>
  <app-layout>
      <template #header>
            <h2>
                User Profile
            </h2>
        </template>

      <v-container>
        <v-row>
            <v-col cols="12" md="4">
                <template v-if="$page.props.jetstream.canUpdateProfileInformation">
                <update-profile-information-form :user="$page.props.user" />
                </template>
            </v-col>

            <v-col cols="12" md="2">
                <template v-if="$page.props.jetstream.canUpdatePassword">
                <update-password-form />
                </template>
            </v-col>
            <v-col cols="12" md="3">
                <template v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                    <two-factor-authentication-form />
                </template>
            </v-col>

            <v-col cols="12" md="3">
                <logout-other-browser-sessions-form :sessions="sessions" />
            </v-col>

            <v-col cols="12" md="4">
                <delete-user-form />
            </v-col>
        </v-row>

      </v-container>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import DeleteUserForm from './DeleteUserForm'
import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
import UpdatePasswordForm from './UpdatePasswordForm'
import UpdateProfileInformationForm from './UpdateProfileInformationForm'

export default {
  props: ['sessions'],

  components: {
    AppLayout,
    DeleteUserForm,
    LogoutOtherBrowserSessionsForm,
    TwoFactorAuthenticationForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm
  },
  beforeMount(){
      console.log(this.$page);
  }
}
</script>
