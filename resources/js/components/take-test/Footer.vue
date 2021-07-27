<template>
  <nav class="navbar fixed-bottom navbar-light bg-light p-0 px-md-3">
    <div class="container-fluid p-0">
      <a
        class="navbar-brand d-none d-md-block"
        href="#"
      >
        <strong>afiniti</strong>
      </a>

      <a-navigation
        class="w-100"
        v-if="!$responsive.isVisible('md')"
        @next="next($event)"
      />
    </div>
  </nav>
</template>

<script>
import ANavigation from './Navigation.vue'
export default {
  name: 'AFooter',
  components: {
    ANavigation
  },
  data () {
    return {}
  },
  methods: {
    next (event) {
      this.$emit('next', event)
    }
  }
}
</script>
