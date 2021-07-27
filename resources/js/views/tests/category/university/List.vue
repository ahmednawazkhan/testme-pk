<template>
  <div>
    <header class="text-left mt-md-3 mb-md-4">
      <h1 class="h4">
        Universities Test
      </h1>
    </header>

    <div class="cards row align-items-center justify-content-start">
      <div class="col-sm-3 mb-4">
        <card />
      </div>
      <div class="col-sm-3 mb-4">
        <card />
      </div>
      <div class="col-sm-3 mb-4">
        <card />
      </div>
      <div class="col-sm-3 mb-4">
        <card />
      </div>
    </div>
  </div>
</template>

<script>
import { Card } from '../../../../components'

export default {
  components: {
    Card
  },
  data () {
    return {}
  }
}
</script>

<style lang="scss" scoped>
  .cards {
    width: 100%;
    display: flex;
    display: -webkit-flex;
    justify-content: center;
    -webkit-justify-content: center;
    margin: 0;
  }
</style>
