<template>
  <div class="mcq-overview container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <div class="header mt-md-5">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">
                  MCQ / Edit question
                </h6>
                <h1 class="header-title">
                  Dashboard
                </h1>
              </div>
              <div class="col-auto">
                <b-button
                  variant="primary"
                  :to="{name: 'mcq-bank'}"
                >
                  MCQ Bank
                </b-button>
              </div>
            </div>
          </div>
        </div>

        <question-editor :question="currentQuestion" />
      </div>
    </div>
  </div>
</template>

<script>
import { QuestionEditor } from '../../../components'
import { createNamespacedHelpers } from 'vuex'

const { mapActions, mapGetters } = createNamespacedHelpers('mcq')

export default {
  components: {
    QuestionEditor
  },
  props: {
    id: {
      type: Number,
      default: 1
    }
  },
  data () {
    return {
    }
  },
  computed: {
    ...mapGetters(['currentQuestion'])
  },
  created () {
    this.fetchQuestions()

    this.setEditingQuestion(this.id)
  },
  methods: {
    ...mapActions(['fetchQuestions', 'setEditingQuestion'])
  }
}
</script>

<style lang="scss" scoped>

</style>
