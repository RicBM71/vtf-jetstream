<template>
  <v-app id="inspire">

    <navigation-drawer :drawer.sync="drawer"></navigation-drawer>
    <app-bar
      :drawer.sync="drawer"
      :toggleNav="toggleNav"
      :user="$page.props.user"
    />

    <v-main class="grey lighten-4">
      <v-container class="py-10">
        <!-- Headings -->
        <headings :hasTitle="hasTitle" :hasSubtitle="hasSubtitle">
          <template v-if="hasTitle" #title>
            <slot name="title"></slot>
          </template>
          <template v-if="hasSubtitle" #subtitle>
            <slot name="subtitle"></slot>
          </template>
        </headings>

        <slot></slot>
      </v-container>
    </v-main>

    <!-- Modal Portal -->
    <portal-target name="modal" multiple></portal-target>
  </v-app>
</template>

<script>
import AppBar from '@/Components/Layout/AuthAppBar'
import Headings from '@/Components/Headings'
import NavigationDrawer from '@/Components/Layout/NavigationDrawer'

export default {
  components: {
    AppBar,
    Headings,
    NavigationDrawer
  },

  data () {
    return {
      showingNavigationDropdown: false,
      drawer: true
    }
  },

  computed: {
    hasTitle () {
      return !!this.$slots.title
    },

    hasSubtitle () {
      return !!this.$slots.subtitle
    }
  },

  watch: {
    drawer (val) {
      return val
    }
  },

  methods: {
    switchToTeam (team) {
      this.$inertia.put(route('current-team.update'), {
        team_id: team.id
      }, {
        preserveState: false
      })
    },

    logout () {
      axios.post(route('logout').url()).then(response => {
        window.location = '/'
      })
    },

    toggleNav () {
      this.drawer = !this.drawer
    }
  }
}
</script>
