<template>
  <div class="result-show py-4">
    <h1 class="mb-4">
      TEST DETAILED RESULT
    </h1>

    <div class="row">
      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <i class="fas fa-percent text-success" />
            <h5 class="card-title">
              PERCENTAGE
            </h5>
            <strong> 66 % </strong>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <i class="fas fa-calendar-check text-success" />
            <h5 class="card-title">
              TAKEN ON
            </h5>
            <strong> December 20, 2018 </strong>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <i class="fas fa-question-circle text-success" />
            <h5 class="card-title">
              TOTAL QUESTIONS
            </h5>
            <strong> 10 </strong>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <i class="fal fa-clock text-success" />
            <h5 class="card-title">
              TIME LIMIT
            </h5>
            <strong> 20 Minutes </strong>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <i class="fas fa-chart-bar text-success" />
            <h5 class="card-title">
              RESULT STATUS
            </h5>
            <strong class="text-success">
              Passed
            </strong>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <i class="far fa-check text-success" />
            <h5 class="card-title">
              TOTAL CORRECT
            </h5>
            <strong> 2 Questions </strong>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card">
          <div class="card-body">
            <i class="far fa-times text-success" />
            <h5 class="card-title">
              TOTAL WRONG
            </h5>
            <strong> 1 Questions </strong>
          </div>
        </div>
      </div>
    </div>

    <h2 class="mt-4">
      Question Wise Analysis
    </h2>

    <div class="row">
      <div class="col mb-4">
        <div class="card">
          <div class="card-body text-left px-1 pb-2">
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <b-button
                  size="sm"
                  variant="success"
                  type="button"
                  class="mx-1 mb-2"
                  @click="showDetails()"
                >
                  1
                </b-button>
                <b-button
                  size="sm"
                  variant="danger"
                  type="button"
                  class="mx-1 mb-2"
                  @click="showDetails()"
                >
                  2
                </b-button>
                <b-button
                  size="sm"
                  variant="success"
                  type="button"
                  class="mx-1 mb-2"
                  @click="showDetails()"
                >
                  3
                </b-button>
              </li>
            </ul>
          </div>
        </div>

        <div class="text-muted text-left mt-2">
          <i class="fal fa-lightbulb" />
          Click on questions to see details
        </div>
      </div>
    </div>

    <b-modal
      ref="detailsModalRef"
      hide-footer
      title="Test name: English Test"
      header-bg-variant="primary"
      header-text-variant="light"
      body-bg-variant="light"
      body-text-variant="dark"
    >
      <dl class="row">
        <dt class="col-sm-3">
          Subject:
        </dt>
        <dd class="col-sm-9">
          English
        </dd>

        <dt class="col-sm-3">
          Chapter:
        </dt>
        <dd class="col-sm-9">
          Grammar
        </dd>

        <dt class="col-sm-3">
          Question:
        </dt>
        <dd class="col-sm-9">
          What is your name ?
        </dd>

        <dt class="col-sm-3">
          Answer:
        </dt>
        <dd class="col-sm-9">
          My name is Eric
        </dd>

        <dt class="col-sm-3">
          Explaination:
        </dt>
        <dd class="col-sm-9" />
      </dl>
    </b-modal>
  </div>
</template>

<script>
export default {
  methods: {
    showDetails (question = null) {
      this.$refs.detailsModalRef.show()
    }
  }
}
</script>

<style lang="scss" scoped>
.card {
  box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12), 0 3px 1px -2px rgba(0,0,0,.2);

  .card-body {
    padding: 1rem;

    .card-title {
      font-size: 1em;
    }

    strong {
      font-size: .8em;
    }
  }
}

.modal-content {
  border-radius: 2px;
  background-color: inherit;

  .modal-header {
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
  }

  .modal-body {
    text-align: left
  }
}
</style>
