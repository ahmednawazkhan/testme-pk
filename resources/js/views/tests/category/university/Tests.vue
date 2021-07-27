<template>
  <div class="text-left">
    <div class="row">
      <div class="col col-sm-12 px-0">
        <div class="university-card">
          <div class="front">
            <div class="university-logo">
              <img
                class="img-fluid img-thumbnail"
                src="../../../../assets/images/harvard-badge.png"
                alt=""
              >
            </div>
            <h1 class="university-name">
              Harvard University
            </h1>
            <div class="university-attribures">
              <ul class="list-inline">
                <li class="list-inline-item">
                  <i class="fal fa-heart" />
                  2000
                </li>
                <li class="list-inline-item">
                  <i class="fal fa-badge-check" />
                </li>
              </ul>
            </div>
            <p class="university-description w-sm-75">
              Harvard University is devoted to excellence in teaching, learning, and research,
              and to developing leaders in many disciplines who make a difference globally.
              Harvard University is a private university in Cambridge, Massachusetts, U.S.,
              and a member of the Ivy League. Founded in 1636 by the colonial Massachusetts
              legislature, Harvard is the oldest institution of higher learning in the United States.
            </p>
          </div>
          <div class="university-cover d-none d-sm-block">
            <img
              class="img-fluid"
              src="../../../../assets/images/harvard-badge.png"
              alt=""
            >
          </div>
        </div>
      </div>
    </div>

    <div class="row sticky-top">
      <div class="col px-0">
        <div class="header p-2 border-top boder-bottom">
          <b-form inline>
            <label
              class="sr-only"
              for="search"
            >
              Keyword
            </label>

            <b-input
              type="search"
              class="w-sm-50 mb-2 mr-sm-2 mb-sm-0"
              id="search"
              placeholder="Keyword"
            />

            <b-form-select
              class="w-50 w-sm-auto mr-2 mb-sm-0"
              id="categories"
              :value="null"
              :options="categories"
            >
              <option
                slot="first"
                :value="null"
              >
                All categories
              </option>
            </b-form-select>

            <b-button variant="primary">
              Search
            </b-button>
          </b-form>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4 px-2">
        <test-card />
      </div>
      <div class="col-sm-4 px-2">
        <test-card :is-free="false" />
      </div>
      <div class="col-sm-4 px-2">
        <test-card />
      </div>
      <div class="col-sm-4 px-2">
        <test-card />
      </div>
      <div class="col-sm-4 px-2">
        <test-card :is-free="false" />
      </div>
      <div class="col-sm-4 px-2">
        <test-card :is-free="false" />
      </div>
      <div class="col-sm-4 px-2">
        <test-card :is-free="false" />
      </div>
      <div class="col-sm-4 px-2">
        <test-card />
      </div>
      <div class="col-sm-4 px-2">
        <test-card />
      </div>
      <div class="col-sm-4 px-2">
        <test-card />
      </div>
    </div>
  </div>
</template>

<script>
import { TestCard } from '../../../../components'

export default {
  components: {
    TestCard
  },
  data () {
    return {
      categories: {
        '1': 'BioMedical',
        '2': 'Law',
        '3': 'Thinking',
        '4': 'Physics',
        '5': 'Mathematics'
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.sticky-top {
  top: 3rem;
  z-index: 14;
}

.university-card {
  border-radius: 10px;
  position: relative;
  background-color: #fbfbfb;
  box-shadow: 0px 0px 50px -25px rgba(0, 0, 0, 0.5)
}

.front {
  background: linear-gradient(to right, #fbfbfb 50%, transparent 100%);
  background-blend-mode: multiply;
  z-index: 2;
  position: relative;
  padding: 1rem 1rem .8rem;
}

.university-logo {
  float: left;
  font-size: 4rem;
  margin-top: -1rem;
  margin-right: 1rem;

  img {
    width: 1.5em;
    height: 1.5em;
  }
}

.university-name {
  font-size: 2rem;
}

.university-description {
  font-size: 1rem;
  font-weight: 300;
  text-align: justify;
  clear: both;
  margin: 0;
}

.university-cover {
  width: 25%;
  height: auto;
  position: absolute;
  top: 10px;
  bottom: 0;
  right: 0;
  padding: 1em;
}

.header {
  border-bottom: 1px solid #dcdcdc;
  padding: 0.65rem 0.5rem;
  box-shadow: 0px 5px 20px -15px black;
  background-color: #f4f4f4;
}

.form-control, button {
  border: none;
  height: calc(2rem + 2px);
  border-radius: 0.15rem;
}

.form-control {
  background: rgba(255, 255, 255, 0.7);
}

@media (max-width: 576px) {
  .university-name {
    font-size: 1.5rem;
  }

  form button {
    width: calc(50% - 0.5rem);
  }
}
</style>
