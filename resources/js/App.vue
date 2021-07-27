<template>
  <main id="app">
    <div v-if="$auth.ready()">
      <router-view />
    </div>

    <div v-if="!$auth.ready()">
      Loading ...
    </div>
  </main>
</template>

<script>

export default {
  name: 'Testmepk',
  data () {
    return {}
  }
}
</script>

<style lang="scss">
  html {
    position: relative;
    min-height: 100%;
  }

  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
  }
</style>
