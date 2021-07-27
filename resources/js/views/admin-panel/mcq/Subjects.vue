<template>
  <div class="container-fluid mcq-subjects">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <div class="header mt-md-5">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">
                  MCQ / Subjects & Chapters
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

        <div class="card">
          <div class="card-header">
            Manage MCQ Suject & characters
          </div>
          <div class="card-body">
            <b-form @submit.prevent="saveSubject()">
              <b-form-group
                label="Subject name"
                label-for="subjectInput"
                label-sr-only
                :description="description"
                :invalid-feedback="invalidFeedback"
                :valid-feedback="validFeedback"
                :state="state"
              >
                <b-form-input id="subjectInput" :state="state" placeholder="Subject name" v-model.trim="$v.newSubject.$model" />
              </b-form-group>
            </b-form>

            <div class="loading" v-if="loading">
              Loading
              <span class="fa-2x">
                <i class="fal fa-spinner-third fa-spin" />
              </span>
            </div>

            <ul class="list-unstyled" v-if="subjects">
              <li
                v-for="subject in subjects"
                :key="subject.id"
              >
                <a-subject @edit="onEdit($event)" :subject.sync="subject" />
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ASubject } from '../../../components'
import { createNamespacedHelpers } from 'vuex'
import { required, minLength } from 'vuelidate/lib/validators'

const { mapGetters, mapActions } = createNamespacedHelpers('mcq')

export default {
  components: {
    ASubject
  },
  data () {
    return {
      newSubject: '',
      loading: false,
      pending: false,
      forUpdate: null
    }
  },
  created () {
    this.loading = true
    this.fetchSubjects()
      .then(subjects => this.loading = false)
  },
  validations: {
    newSubject: {
      required,
      minLength: minLength(4)
    }
  },
  computed: {
    ...mapGetters(['subjects']),
    description () {
      return this.pending ? 'Pending...' : ''
    },
    state () {
      return this.$v.newSubject.$dirty ?
        this.$v.newSubject.$error ? false : true : null
    },
    invalidFeedback () {
      if (this.$v.newSubject.$required) {
        return 'Please enter something'
      } else if (this.$v.newSubject.$minLength) {
        return 'Enter at least 4 characters'
      } else {
        return ''
      }
    },
    validFeedback () {
      return ''
    }
  },
  methods: {
    ...mapActions(['fetchSubjects', 'createSubject', 'updateSubject']),
    saveSubject () {
      this.pending = true

      this.$v.$touch()

      if (this.$v.$invalid) {
        this.pending = false
      } else {
        this.loading = true

        if (!this.forUpdate) {
          this.createSubject(this.newSubject)
            .then((subject) => {
              this.pending = false
              this.loading = false
              this.newSubject = ''
              this.$v.$reset()
            }, error => {
              console.log(error)
              this.pending = false
              this.loading = false
            })
        } else {
          this.doUpdate()
        }
      }
    },
    onEdit (subject) {
      this.forUpdate = subject
      this.newSubject = this.forUpdate.label
    },
    doUpdate () {
      this.updateSubject({ id: this.forUpdate.id, label: this.newSubject })
        .then(resp => {
          this.loading = false
          this.forUpdate = null
        }, error => {
          console.log(error)
          this.pending = false
          this.loading = false
          this.forUpdate = null
        })
    }
  }
}
</script>

<style lang="scss" scoped>
.loading {
  position: absolute;
  bottom: 0;
  right: 1em;
}
</style>
