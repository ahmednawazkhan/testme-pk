<template>
  <article class="test-instructions">
    <b-button
      class="float-left mb-2 pl-0"
      variant="link"
      type="button"
      :to="{name: 'tests', params: {slug: 'havard-university'}}"
    >
      <i class="fal fa-arrow-circle-left" />
      Back to all tests
    </b-button> <br>

    <div class="row clearfix">
      <div class="col text-left mb-2">
        <h4 class="text-left">
          English Spelling Test (U.S. Version)
          <small>English Language</small>
        </h4>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-8">
        <div class="instructions-card">
          <p class="card-text">
            This test is about 45 multiple choice questions and should take less than 45 minutes to complete.
          </p>

          <b-button
            variant="primary"
            v-b-modal.tourGuide
          >
            Take tour / Take test
          </b-button>
          <br>

          <div class="text-muted mt-4">
            <i class="fal fa-lightbulb" />
            An information goes here.
          </div>
        </div>
      </div>

      <div class="col-sm-4 text-left mt-2 mt-md-0">
        <h5 class="mb-1">
          Test Contents
        </h5>

        <ul class="pl-4">
          <li>
            <strong>Spelling</strong> 3 questions
          </li>
          <li>
            <strong>Grammar</strong> 10 questions
          </li>
          <li>
            <strong>Greating</strong> 10 questions
          </li>
        </ul>
      </div>
    </div>

    <b-modal
      id="tourGuide"
      body-bg-variant="dark"
      body-text-variant="white"
      footer-bg-variant="dark"
      centered
      cancel-title="Skip tour"
      ok-title="Start tour"
      @cancel="cancelTour"
      @ok="StartTour"
      hide-header
    >
      <h1 class="header">
        Introducing Afiniti Test
      </h1>
      <p>
        Welcome to Afiniti
      </p>
      <p>
        Let’s take a tour of Afinit test features.
      </p>
    </b-modal>
  </article>
</template>

<script>
export default {
  methods: {
    cancelTour () {
      this.$router.push({ name: 'test' })
    },
    StartTour () {
      this.$router.push({ name: 'tour-guide' })
    }
  }
}
</script>

<style lang="scss" scoped>
  .clearfix {
    clear: both;
  }

  .instructions-card {
    position: relative;
    width: 100%;
    height: auto;
    background-color: #ffffff;
    text-align: left;
    padding: 1rem;
    box-shadow: 0 1px 6px rgba(57,73,76,0.35);

    .btn {
      box-shadow: 0 1px 6px rgba(57,73,76,0.35);
      border-radius: 2px;
    }

    p {
      line-height: 21px;
    }
  }
</style>
