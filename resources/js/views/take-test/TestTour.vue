<template>
  <div class="main-content">
    <a-header />

    <section
      class="container-fluid"
      id="test-sections"
    >
      <div class="row py-1 border-bottom">
        <div class="col-md-4 col-sm-6 align-self-sm-center order-last order-md-first d-none d-md-block">
          <a-section />
        </div>

        <div
          class="col-md-4 align-self-sm-center d-none d-md-block"
          v-if="$responsive.isVisible('md')"
        >
          <a-pagination />
        </div>

        <div class="col-md-4 text-left order-first order-md-last my-2 my-md-0 d-none d-md-block">
          <a-progres />
        </div>
        <div
          class="col d-md-none"
          v-if="!$responsive.isVisible('md')"
        >
          <span class="navbar-text border rounded p-1 my-1 text-name">
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
        </div>
      </div>

      <div
        class="row d-md-none"
        v-if="$responsive.isVisible('xs')"
      >
        <div class="col-12 mt-2">
          <a-pagination />
        </div>
      </div>

      <div
        class="row mt-4"
        v-if="currentSection"
      >
        <div class="col-md-6 col-12 text-left">
          <div class="card border-0 question-item">
            <div class="card-header bg-light border-0 rounded">
              <strong>Question # {{ currentSection.currentQuestion + 1 }}</strong>

              <div
                class="float-right"
                v-if="currentQuestion && !currentQuestion.revisit"
              >
                <a
                  @click="revisit()"
                  class="btn-link btn-revisit mr-1"
                  role="button"
                >
                  <i
                    class="fa fa-repeat text-danger"
                    aria-hidden="true"
                  />
                  <span class="ml-2">
                    Revisit
                  </span>
                </a>
                <i
                  class="far fa-question-circle"
                  aria-hidden="true"
                  v-b-tooltip.hover
                  title="This action allows you to mark the current question for review.
                        Very useful if you are not sure of the correct answer and decide to
                        revisit this question later
                        Click on Revisit to continue"
                />
              </div>
            </div>
            <div class="card-body">
              <p class="card-text question-content">
                {{ currentQuestion.label }}
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-12 text-left">
          <div class="card border-0 question-options">
            <div class="card-header bg-light border-0 rounded">
              <strong>Choose best option</strong>

              <div class="float-right">
                <a
                  @click="resetForm()"
                  role="button"
                  class="btn-link btn-erase"
                >
                  <i
                    class="fa fa-eraser"
                    aria-hidden="true"
                  />
                  <span class="ml-2 mr-1 btn-reset">
                    Reset
                  </span>
                  <i
                    class="far fa-question-circle"
                    aria-hidden="true"
                    v-b-tooltip.hover
                    title="This button allows you to put a question to its original state."
                  />
                </a>
              </div>
            </div>
            <div class="card-body">
              <form
                action=""
                ref="form"
              >
                <fieldset>
                  <div
                    v-for="(field, index) in currentQuestion.fields"
                    :key="index"
                    :class="{
                      'custom-control custom-checkbox': field.type === 'checkbox',
                      'custom-control custom-radio': field.type === 'radio',
                      'form-group': field.type === 'text' || field.type === 'select'
                    }"
                  >
                    <label
                      v-if="field.type === 'text' || field.type === 'select'"
                      :for="field.name + index"
                    >
                      {{ field.label }}
                    </label>
                    <input
                      required
                      v-model="answer"
                      v-if="field.type === 'radio'"
                      :value="field.value"
                      type="radio"
                      :id="field.name + index"
                      :name="field.name"
                      class="custom-control-input"
                    >
                    <input
                      v-model="answer"
                      v-if="field.type === 'checkbox'"
                      :value="field.value"
                      type="checkbox"
                      :id="field.name + index"
                      :name="field.name"
                      class="custom-control-input"
                    >
                    <label
                      required
                      v-if="field.type === 'radio' || field.type === 'checkbox'"
                      class="custom-control-label"
                      :for="field.name + index"
                    >
                      {{ field.label }}
                    </label>
                    <select
                      required
                      v-model="answer"
                      class="form-control"
                      v-if="field.type === 'select'"
                      :id="field.name + index"
                      :name="field.name"
                    >
                      <option
                        v-for="(item, index_second) in field.data"
                        :key="index_second"
                        :value="item.value"
                      >
                        {{ item.text }}
                      </option>
                    </select>
                    <input
                      required
                      v-model="answer"
                      v-if="field.type === 'text'"
                      type="text"
                      :id="field.name + index"
                      :name="field.name"
                      class="form-control"
                    >
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div
        class="row sticky-top"
        v-if="$responsive.isVisible('md')"
      >
        <div class="col-12 col-md-4 offset-md-6 mt-md-5 text-center">
          <a-navigation @next="next($event)" />
        </div>
      </div>
    </section>

    <v-tour
      name="myTour"
      :steps="steps"
      :callbacks="callbacks"
    >
      <template slot-scope="tour">
        <transition-group name="fade">
          <div
            v-for="(step, index) of tour.steps"
            :key="index + 1"
          >
            <v-step
              v-if="tour.currentStep === index"
              :step="step"
              :previous-step="tour.previousStep"
              :next-step="tour.nextStep"
              :stop="tour.stop"
              :is-first="tour.isFirst"
              :is-last="tour.isLast"
              :labels="tour.labels"
            >
              <template v-if="[7, 9, 11].includes(tour.currentStep)">
                <div slot="actions">
                  <button
                    @click="tour.stop"
                    class="v-step__button"
                  >
                    Skip tour
                  </button>
                  <button
                    @click="tour.previousStep"
                    class="v-step__button"
                  >
                    Previous
                  </button>
                </div>
              </template>
            </v-step>
          </div>
        </transition-group>
      </template>
    </v-tour>
    <a-footer @next="next($event)" />
  </div>
</template>

<script>
import testData from '../../assets/data.json'
import {
  Header, Footer, Pagination, Section, Progres, Navigation
} from '../../components'
import { createNamespacedHelpers } from 'vuex'

const { mapGetters, mapActions } = createNamespacedHelpers('takeTest')

export default {
  components: {
    'a-header': Header,
    'a-footer': Footer,
    'a-pagination': Pagination,
    'a-section': Section,
    'a-progres': Progres,
    'a-navigation': Navigation
  },
  data () {
    return {
      tourGuide: null,
      steps: [
        {
          target: '.text-name',
          header: {
            title: 'Test name'
          },
          content: 'The name of the test you are currently running'
        },
        {
          target: '#section',
          header: {
            title: 'Test sections'
          },
          content: `
            The list of sections of the current test.
            You can change sections and answer the questions in this section.
          `
        },
        {
          target: '.paginations-section',
          header: {
            title: 'Question Paginnation'
          },
          content: `
            You have here the expanded list of questions from the current section.
            you can easily move from one question to another or from one slice of questions
            to another with the << and >> buttons`
        },
        {
          target: '.test-evolution',
          header: {
            title: 'Test progress bar'
          },
          content: `
          This progress bar gives you a global overview of your evolution on the test. <br>
          It involves:
          <ul>
            <li>
              a section of unanswered questions
            </li>
            <li>
              a section of skipped questions
            </li>
            <li>
              a section of answered questions
            </li>
            <li>
              a section of questions to revisit
            </li>
          </ul>
          `
        },
        {
          target: '.question-item',
          header: {
            title: 'Question item'
          },
          content: `
            This section shows the current question and contains its contents
          `
        },
        {
          target: '.question-options',
          header: {
            title: 'Question options'
          },
          content: `
            This section shows you the possible options for the current question.
            You will have to answer the question here.
          `
        },
        {
          target: '.test-navigation',
          header: {
            title: 'Test navigation buttons'
          },
          content: `
            The next, previous and skip buttons let you navigate from one question to another sequentially.
          `
        },
        {
          target: '.btn-revisit',
          header: {
            title: 'Revisit Button'
          },
          content: `
            This action allows you to mark the current question for review. <br>
            <strong>Very useful if you are not sure of the correct answer and decide to
            revisit this question later</strong> <br>
            Click on "Revisit" to continue
          `
        },
        {
          target: '.test-evolution .revisit-progress',
          header: {
            title: 'Revisit Progress bar'
          },
          content: `
            This bar in red color indicates the number of questions marked as revisit.
          `
        },
        {
          target: '.test-navigation .btn-skip',
          header: {
            title: 'Skip button'
          },
          content: `
            You can ignore the current question with this button. <br>
            Click on "Skip" to continue
          `
        },
        {
          target: '.test-evolution .skiped-progress',
          header: {
            title: 'Skiped questions'
          },
          content: `
            This bar in yellow color indicates the number of questions marked as ignored
          `
        },
        {
          target: '.question-options form',
          header: {
            title: 'Choose an option'
          },
          content: `
            Choose an answer option please !
          `,
          params: {
            placement: 'left'
          }
        },
        {
          target: '.test-evolution .answered-progress',
          header: {
            title: 'Answered questions'
          },
          content: `
            This bar in green color indicates the number of questions answered
          `
        },
        {
          target: '.btn-erase',
          header: {
            title: 'Reset button'
          },
          content: `
            This button allows you to put a question to its original state.
          `
        }
      ],
      callbacks: {
        onStart: this.onTourStart,
        onStop: this.onTourStop,
        onPreviousStep: this.myCustomPreviousStepCallback,
        onNextStep: this.myCustomNextStepCallback
      }
    }
  },
  computed: {
    ...mapGetters(['currentSection', 'currentQuestion', 'test']),
    answer: {
      get () {
        return this.currentQuestion.answer
      },
      set (value) {
        this.currentQuestion.answer = value

        if (value) {
          this.currentQuestion.answered = true
          this.currentQuestion.revisit = false
          this.currentQuestion.ignored = false
        }

        if (this.tourGuide.currentStep === 11) {
          setTimeout(() => this.tourGuide.nextStep(), 600)
        }
      }
    }
  },
  methods: {
    ...mapActions(['doNext', 'loadData', 'defineSection', 'defineQuestion']),
    revisit () {
      if (!this.currentQuestion.answered) {
        this.currentQuestion.revisit = true
        this.currentQuestion.ignored = false
        this.doNext({ check: false })

        if (this.tourGuide.currentStep === 7) {
          setTimeout(() => this.tourGuide.nextStep(), 600)
        }
      }
    },
    resetForm () {
      this.$refs.form.reset()
      this.currentQuestion.answer = null
      this.currentQuestion.answered = false

      if (this.tourGuide.currentStep === 13) {
        setTimeout(() => this.tourGuide.nextStep(), 600)
      }
    },
    next (check = false) {
      let valid
      if (check) {
        valid = this.$refs.form.checkValidity()
      }

      this.doNext({ check, valid })

      if (this.tourGuide.currentStep === 9) {
        setTimeout(() => this.tourGuide.nextStep(), 600)
      }

      scrollTo(0, 45)
    },
    myCustomPreviousStepCallback (currentStep) {
      console.log('On previous')
    },
    myCustomNextStepCallback (currentStep) {
      if (currentStep === 8) {
        this.loadData(testData)
        this.defineSection(this.test.sections[0])
        this.defineQuestion(this.currentSection.questions[0])
      }
    },
    onTourStart () {
      sessionStorage.setItem('tourStarted', true)
    },
    onTourStop () {
      sessionStorage.setItem('tourCompleted', true)
      this.$router.push({ name: 'test' })
    }
  },
  mounted () {
    this.$tours['myTour'].start()
    this.tourGuide = this.$tours['myTour']
  }
}
</script>

<style lang="scss" scoped>
.main-content {
  margin-bottom: 6rem;
}
  .v-tour {
    .v-step {
      z-index: 1030;
    }
  }
</style>
