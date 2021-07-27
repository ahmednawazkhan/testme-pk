<template>
  <div
    v-if="currentQuestion"
    class="test-navigation px-md-2"
  >
    <button
      @click="doPrev({check: false})"
      v-if="currentSection.currentQuestion > 0"
      type="button"
      class="btn-previous btn btn-primary float-left"
    >
      Previous
    </button>
    <div
      v-if="currentSection.currentQuestion !== currentSection.questions.length - 1"
      class="d-inline float-right"
    >
      <button
        @click="next()"
        v-if="currentQuestion.answer"
        type="button"
        class="btn-next btn btn-primary ml-1"
      >
        Next
      </button>
      <button
        @click="next()"
        v-else
        type="button"
        class="btn-skip btn btn-warning ml-1"
      >
        Skip
      </button>
    </div>
    <div
      class="d-inline float-right"
      v-else
    >
      <button
        @click="completeSection()"
        type="button"
        class="btn-complete btn btn-primary ml-1"
        :class="{'btn-warning': !currentQuestion.answer && !currentQuestion.revisit}"
      >
        <template v-if="!currentQuestion.answer && !currentQuestion.revisit">
          Skip / Next Section
        </template>
        <template v-else>
          Next Section
        </template>
      </button>
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'

const { mapGetters, mapActions } = createNamespacedHelpers('takeTest')

export default {
  name: 'ANavigation',
  data () {
    return {}
  },
  computed: {
    ...mapGetters(['test', 'currentSection', 'currentQuestion']),
    nextTarget () {
      return this.test
        .sections
        .find(
          (section) => section.index === (this.currentSection.index + 1)
        )
    }
  },
  methods: {
    ...mapActions(['doPrev', 'defineQuestion', 'nextSection']),
    next () {
      this.$emit('next', true)
    },
    completeSection () {
      this.next()

      if (this.nextTarget) {
        this.nextSection(this.nextTarget)
        this.defineQuestion(
          this.currentSection.questions[this.currentSection.currentQuestion]
        )
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@media (max-width: 768px) {
  .test-navigation button {
    border-radius: 0 !important;
    box-shadow: 0 0 20px -10px black;
  }

  .btn-previous, .float-right {
    width: 50%;
  }

  .btn-next, .btn-skip, .btn-complete {
    width: 100%;
  }
}
</style>
