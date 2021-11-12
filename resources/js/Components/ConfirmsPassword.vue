<template>
  <v-container>
    <v-btn
      block
      small
      :loading="form.processing"
      @click="startConfirmingPassword"
    >
      <slot />
    </v-btn>

    <modal
      :show="confirmingPassword"
      @close="confirmingPassword = false"
    >
      <template #title>
        {{ title }}
      </template>

      <template #content>
        <p>
          {{ content }}
        </p>

        <!-- Password Field -->
        <v-text-field
          outlined
          ref="password"
          label="Password"
          v-model="form.password"
          autocomplete="current-password"
          :type="showPassword ? 'text' : 'password'"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          :error-messages="form.error"
          @click:append="showPassword = !showPassword"
          @keyup.enter.native="confirmPassword"
        ></v-text-field>
      </template>

      <template #footer>
        <v-spacer></v-spacer>

        <v-btn
          small
          @click.native="confirmingPassword = false"
        >
          Cancelar
        </v-btn>

        <v-btn
          small
          @click.native="confirmPassword"
          :disabled="form.processing"
        >
          {{ button }}
        </v-btn>
      </template>
    </modal>
  </v-container>
</template>

<script>
import Modal from './Modal'

export default {
  props: {
    title: {
      default: 'Confirm Password'
    },
    content: {
      default: 'For your security, please confirm your password to continue.'
    },
    button: {
      default: 'Confirm'
    }
  },

  components: {
    Modal
  },

  data () {
    return {
      confirmingPassword: false,

      form: this.$inertia.form({
        password: '',
        error: ''
      }, {
        bag: 'confirmPassword'
      }),

      showPassword: false
    }
  },

  methods: {
    startConfirmingPassword () {
      this.form.error = ''

      axios.get(route('password.confirmation')).then(response => {
        if (response.data.confirmed) {
          this.$emit('confirmed')
        } else {
          this.confirmingPassword = true
          this.form.password = ''

          setTimeout(() => {
            this.$refs.password.focus()
          }, 250)
        }
      })
    },

    confirmPassword () {
      this.form.processing = true

      axios.post(route('password.confirm'), {
        password: this.form.password
      }).then(response => {
        this.confirmingPassword = false
        this.form.password = ''
        this.form.error = ''
        this.form.processing = false

        this.$nextTick(() => this.$emit('confirmed'))
      }).catch(error => {
        this.form.processing = false
        this.form.error = error.response.data.errors.password[0]
      })
    }
  }
}
</script>
