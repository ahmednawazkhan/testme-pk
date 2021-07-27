<template>
  <div class="main-content">
    <a-header
      :test-finished="testFinished"
      @finished="onTestFinished($event)"
    />

    <section
      class="container-fluid"
      id="test-sections"
    >
      <div class="row py-1 border-bottom">
        <div class="col-md-3 col-sm-6 align-self-sm-center order-last order-md-first d-none d-md-block">
          <a-section />
        </div>

        <div
          class="col-md-5 align-self-sm-center d-none d-md-block"
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
          <div class="float-left">
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

          <div class="float-right">
            <button
              type="button"
              @click="finishTest()"
              class="ml-1 btn btn-sm btn-light d-md-none"
            >
              Finish Test
            </button>
          </div>
        </div>
      </div>

      <div
        class="row d-md-none"
        v-if="$responsive.isVisible('xs')"
      >
        <div class="col-12 mt-2 px-0">
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
              <strong
                class="px-2 question-title"
                :class="{
                  'ignored': currentQuestion.ignored,
                  'revisit': currentQuestion.revisit,
                  'answered': currentQuestion.answered
                }"
              >
                Question # {{ currentSection.currentQuestion + 1 }}
              </strong>

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

    <b-modal
      body-bg-variant="dark"
      body-text-variant="white"
      footer-bg-variant="dark"
      centered
      @cancel="testFinished = false"
      ok-title="Confirm Action"
      ref="completeTestModal"
      hide-header
    >
      <h1 class="header">
        Submit answers
      </h1>
      <p>
        Do you confirm your choice ?
      </p>
    </b-modal>

    <a-footer @next="next($event)" />
  </div>
</template>

<script>
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
      testFinished: false
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
      }
    }
  },
  methods: {
    ...mapActions(['doNext']),
    revisit () {
      if (!this.currentQuestion.answered) {
        this.currentQuestion.revisit = true
        this.currentQuestion.ignored = false
        this.doNext({ check: false })
      }
    },
    resetForm () {
      this.$refs.form.reset()
      this.currentQuestion.answer = null
      this.currentQuestion.answered = false
    },
    next (check = false) {
      let valid
      if (check) {
        valid = this.$refs.form.checkValidity()
      }

      this.doNext({ check, valid })

      scrollTo(0, 45)
    },
    finishTest () {
      this.testFinished = true
    },
    onTestFinished (timer) {
      this.$refs.completeTestModal.show()
    }
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

.question-title {
  border-right: solid #6c757d;

  &.ignored {
    border-right-color: #ffc107;
  }

  &.revisit {
    border-right-color: #dc3545;
  }

  &.answered {
    border-right-color: #28a745;
  }
}
</style>
