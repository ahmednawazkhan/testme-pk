<template>
  <div
    class="test-evolution border rounded"
    v-if="allQuestions"
  >
    <button
      class="btn btn-sm all-btn"
      v-b-tooltip.hover
      title="This progress bar gives you a global overview of your evolution on the test.
      It involves:
          a section of unanswered questions;
          a section of skipped questions;
          a section of answered questions;
          a section of questions to revisit"
    >
      <i
        class="far fa-question-circle"
        aria-hidden="true"
      />
    </button>
    <div class="progress-container">
      <b-progress
        height="2.3rem"
        class="rounded-right"
        :max="allQuestions.length"
        show-value
      >
        <b-progress-bar
          class="answered-progress"
          v-b-tooltip.hover
          title="Anwered questions"
          :max="fakeMax(answered.length)"
          :value="answered.length"
          variant="success"
          @click.native="goToQuestion(answered)"
        />
        <b-progress-bar
          class="skiped-progress"
          v-b-tooltip.hover
          title="Skiped questions"
          :max="fakeMax(ignored.length)"
          :value="ignored.length"
          variant="warning"
          @click.native="goToQuestion(ignored)"
        />
        <b-progress-bar
          class="revisit-progress"
          v-b-tooltip.hover
          title="Revisit questions"
          :max="fakeMax(toBeReviewed.length)"
          :value="toBeReviewed.length"
          variant="danger"
          @click.native="goToQuestion(toBeReviewed)"
        />
        <b-progress-bar
          v-b-tooltip.hover
          title="Remaining questions"
          :value="remainings.length"
          variant="secondary"
          @click.native="goToQuestion(remainings)"
        />
      </b-progress>
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'

const { mapGetters, mapActions } = createNamespacedHelpers('takeTest')

export default {
  name: 'AProgres',
  data () {
    return {}
  },
  computed: {
    ...mapGetters(['allQuestions', 'test', 'currentSection']),
    answered () {
      return this.allQuestions
        .filter(question => question.answered === true)
    },
    ignored () {
      return this.allQuestions
        .filter(question => question.ignored === true)
    },
    toBeReviewed () {
      return this.allQuestions
        .filter(question => question.revisit === true)
    },
    remainings () {
      return this.allQuestions
        .filter(question => {
          return (question.ignored === false) &&
            (question.answered === false) && (question.revisit === false)
        })
    }
  },
  methods: {
    ...mapActions(['defineSection', 'defineQuestion']),
    fakeMax (section) {
      if (section <= 3) {
        return 10
      }

      return this.allQuestions.length
    },
    goToQuestion (filtered) {
      const targetQuestion = filtered[0]
      const targetSection = this.test.sections[targetQuestion.section]

      this.defineSection(targetSection)
      this.defineQuestion(targetQuestion)
      this.currentSection.currentQuestion = targetQuestion.index
    }
  }
}
</script>

<style lang="scss" scoped>
  .test-evolution {
    display: flex;
    .progress-container {
      align-self: center;
      width: 100%;

      .progress {
        border-radius: 0;
      }
    }

    .all-btn {
      border-radius: unset;
    }
  }
</style>
