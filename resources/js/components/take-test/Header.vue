<template>
  <nav class="navbar py-1 py-md-0 px-1 navbar-expand-lg fixed-top navbar-dark bg-primary border-bottom mb-1">
    <div class="container-fluid">
      <b-link
        :to="{name: 'universities'}"
        class="navbar-brand mb-0 h1 text-center d-none d-md-inline-block"
      >
        <strong>afiniti</strong>
      </b-link>

      <span
        class="navbar-text border rounded p-1 d-none d-md-inline-block text-name text-white"
        v-if="$responsive.isVisible('md')"
      >
        <span class="text-truncate">
          {{ test.name }}
        </span>
        <i
          class="ml-2 fa fa-info-circle"
          aria-hidden="true"
          v-b-tooltip.hover
          title="The name of the test you are currently running"
        />
      </span>

      <form
        class="d-block d-md-none text-white"
        v-if="!$responsive.isVisible('md')"
      >
        <a-section />
      </form>

      <span class="navbar-text text-white">
        <i
          class="far fa-question-circle"
          aria-hidden="true"
          v-b-tooltip.hover
          title="Total time limit you have to complete this test"
        />

        <countdown
          :left-time="7200000"
          ref="timer"
          @onFinish="completeTest($event)"
        >
          <span
            slot="process"
            slot-scope="{ timeObj }"
          >
            {{ `${timeObj.h}:${timeObj.m}:${timeObj.s}` }}
          </span>
          <span
            slot="finish"
          >
            Time finished
          </span>
        </countdown>

        <button
          type="button"
          @click="finishTest"
          class="ml-1 btn btn-sm btn-light d-none d-md-inline-block"
        >
          Finish Test
        </button>
      </span>

      <span
        class="navbar-text pb-0 d-md-none w-100"
        v-if="!$responsive.isVisible('md')"
      >
        <a-progres />
      </span>
    </div>
  </nav>
</template>

<script>
import ASection from './Section.vue'
import AProgres from './Progres.vue'
import { createNamespacedHelpers } from 'vuex'

const { mapGetters } = createNamespacedHelpers('takeTest')

export default {
  name: 'ANavbar',
  components: {
    ASection,
    AProgres
  },
  props: {
    testFinished: {
      default: false,
      type: Boolean
    }
  },
  data () {
    return {
    }
  },
  mounted () {
  },
  beforeDestroy () {
    this.$refs.timer.finishCountdown()
  },
  computed: {
    ...mapGetters(['test'])
  },
  watch: {
    testFinished (value) {
      if (value) {
        this.finishTest()
      }
    }
  },
  methods: {
    completeTest (vm) {
      console.log('Counter is stoped')
    },
    finishTest () {
      this.$emit('finished', this.$refs.timer)
      // this.$refs.timer.finishCountdown()
    }
  }
}
</script>

<style lang="scss" scoped>
  @media (min-width: 768px) {
    nav.navbar {
      height: 48px;
    }
  }

  form {
    font-size: .8rem;

    /deep/ .custom-select {
      height: calc(2rem + 2px);
    }
  }

  button {
    &:active, &:hover, &:focus {
      border: rgba(0, 120, 215, 0.23) 2px solid;
      box-shadow: 0px 0 30px 1px #b5d6f6;
    }
  }
</style>
