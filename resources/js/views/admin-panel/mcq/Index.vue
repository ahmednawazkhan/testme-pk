<template>
  <div class="mcq-overview container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <div class="header mt-md-5">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">
                  MCQ / Create
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

        <question-editor />
      </div>
    </div>
  </div>
</template>

<script>
import { QuestionEditor } from '../../../components'

export default {
  components: {
    QuestionEditor
  }
}
</script>

<style lang="scss" scoped>

</style>
