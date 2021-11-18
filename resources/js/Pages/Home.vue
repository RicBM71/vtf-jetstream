<template>
  <div>
    <Head title="Welcome" />
    <H1>Welcome</H1>
    <p>Hello {{ $page.props.user.name }}, welcome to your first Inertia app!</p>
  </div>
</template>

<script>
  import Layout from './Layout'
  import { Head } from '@inertiajs/inertia-vue'

  export default {
    components: {
      Head,
      Layout,
    },
  }
</script>
