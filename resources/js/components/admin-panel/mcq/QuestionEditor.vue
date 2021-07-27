<template>
  <b-form
    @submit.prevent="onSave()"
  >
    <div class="form-row">
      <div class="col-12 col-md-4">
        <b-form-group
          label="Subject"
          description="You can create a subject that does not exist yet"
          label-for="subject"
        >
          <v-select
            ref="subjectSelector"
            id="subject"
            placeholder="Choose ..."
            taggable
            :push-tags="false"
            :options="subjects"
            @option:created="onCreateSubject($event)"
            v-model="newMcq.subject"
          >
            <template
              slot="option"
              slot-scope="option"
            >
              {{ option.label }}
              <span
                v-if="!option.chapters"
                class="badge badge-pill badge-secondary"
              >
                Create new
              </span>
            </template>
          </v-select>
        </b-form-group>
      </div>

      <div class="col-12 col-md-4">
        <b-form-group
          label="Chapter"
          description="You can create a chapter that does not exist yet"
          label-for="chapter"
        >
          <v-select
            ref="chapterSelector"
            id="chapter"
            placeholder="Choose ..."
            taggable
            :push-tags="false"
            :options="newMcq.subject.chapters"
            @option:created="onCreateChapter($event)"
            v-model="newMcq.chapter"
          >
            <template
              slot="option"
              slot-scope="option"
            >
              {{ option.label }}
              <span
                v-if="!option.id"
                class="badge badge-pill badge-secondary"
              >
                Create new
              </span>
            </template>
          </v-select>
        </b-form-group>
      </div>

      <div class="col-12 col-md-4">
        <b-form-group
          label="Difficulty"
          label-for="difficulty"
        >
          <b-form-select
            id="difficulty"
            v-model="newMcq.level"
          >
            <option value="easy">
              Easy
            </option>
            <option value="medium">
              Medium
            </option>
            <option value="hard">
              Hard
            </option>
          </b-form-select>
        </b-form-group>
      </div>
    </div>

    <hr class="mt-4 mb-5">

    <b-form-group
      label="Question text"
    >
      <quill-editor
        v-model="newMcq.question.topic"
        :options="quillOptions"
      />
    </b-form-group>

    <hr class="mt-4 mb-5">

    <div class="form-row">
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label>Multiple choice question ?</label>
          <small class="form-text text-muted">
            This option allows you to define several possible answers for your question.
          </small>
          <div class="custom-control custom-checkbox-toggle mt-2">
            <input
              v-model="newMcq.question.isMultiple"
              type="checkbox"
              class="custom-control-input"
              id="exampleToggle"
              checked=""
            >
            <label
              class="custom-control-label"
              for="exampleToggle"
            />
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="mb-2">
              <i class="fal fa-exclamation-triangle" /> Warning
            </h4>

            <p class="small text-muted mb-0">
              Once a question is made "multiple choice",
              make sure to select correct answer when you choose to revert it back to single option.
            </p>
          </div>
        </div>
      </div>
    </div>

    <hr class="mt-4 mb-5">

    <b-form-group
      v-for="(answer, index) in newMcq.question.options"
      :key="index"
    >
      <template slot="label">
        Answer option {{ index + 1 }}
      </template>
      <quill-editor
        v-model="answer.topic"
        :options="quillOptions"
      />
      <b-button-toolbar
        justify
      >
        <b-button-group
          size="sm"
          class="w-100"
        >
          <b-button
            class="w-50"
            variant="primary"
            :pressed="answer.isCorrect"
            @click="checkCorrectAnswer(answer)"
          >
            {{ answer.isCorrect ? 'Correct answer' : 'Wrong answer' }}
          </b-button>
          <b-button
            class="w-50"
            variant="secondary"
            @click="removeAnswer(answer, index)"
          >
            Remove
          </b-button>
        </b-button-group>
      </b-button-toolbar>
    </b-form-group>

    <b-button
      block
      variant="outline-primary"
      @click="addAnOption"
    >
      <i class="fal fa-plus-circle" />
      Add an option
    </b-button>

    <hr class="mt-4 mb-5">

    <b-form-group
      label="Explaination"
    >
      <quill-editor
        v-model="newMcq.question.explaination"
        :options="quillOptions"
      />
    </b-form-group>

    <hr class="mt-4 mb-5">

    <b-button
      block
      type="submit"
      variant="primary"
      class="mb-2"
    >
      <i class="fal fa-save" />
      Save
    </b-button>
  </b-form>
</template>

<script>
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

import VSelect from 'vue-select'
import { quillEditor } from 'vue-quill-editor'

import Question from '../../../models/question'

import { createNamespacedHelpers } from 'vuex'

const { mapGetters, mapActions } = createNamespacedHelpers('mcq')

export default {
  name: 'QuestionEditor',
  components: {
    VSelect,
    quillEditor
  },
  props: {
    question: {
      default: false,
      type: Question
    }
  },
  data () {
    return {
      quillOptions: {
        modules: {
          toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            ['size', 'header', 'color', 'font', 'align'],
            ['list', 'indent', 'direction'],
            ['blockquote', 'code-block'],
            ['clean']
          ]
        }
      },
      subjectOptions: [],
      newMcq: {
        subject: [],
        level: 'easy',
        chapter: [],
        question: {
          topic: '',
          explaination: '',
          isMultiple: false,
          options: []
        }
      }
    }
  },
  created () {
    this.fetchSubjects()

    if (this.question) {
      this.newMcq = this.question
    }
  },
  mounted () {
    console.log('La question a editer', this.question)
  },
  computed: {
    ...mapGetters(['subjects'])
  },
  methods: {
    ...mapActions(
      [
        'fetchSubjects', 'createSubject', 'createChapter',
        'createQuestion', 'findQuestion'
      ]
    ),
    addAnOption () {
      this.newMcq
        .question
        .options
        .push({
          topic: '',
          isCorrect: false
        })
    },
    checkCorrectAnswer (answer) {
      if (!this.newMcq.question.isMultiple) {
        this.newMcq.question.options.map((item) => {
          if (item !== answer) {
            item.isCorrect = false
          }
        })
      }

      answer.isCorrect = !answer.isCorrect
    },
    removeAnswer (answer, index) {
      this.newMcq.question.options.splice(index, 1)
    },
    onCreateSubject (newOption) {
      this.createSubject(newOption.label)
    },
    onCreateChapter (newOption) {
      const payload = {
        subject: this.newMcq.subject.label,
        chapter: newOption
      }

      this.createChapter(payload)
    },
    onSave () {
      if (this.question) {
        this.resetForm()
      } else {
        this.createQuestion(this.newMcq)
          .then(() => {
            this.resetForm()
          })
      }
    },
    resetForm () {
      this.question = false
      this.newMcq = {
        subject: [],
        level: 'easy',
        chapter: [],
        question: {
          topic: '',
          explaination: '',
          isMultiple: false,
          options: []
        }
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.v-select {
    display: inline-block;
    width: 100%;
    height: calc(2.25rem + 2px);
    line-height: 1.5;
    color: #495057;
    vertical-align: middle;
    background: #fff url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' v…0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right 0.75rem center;
    background-size: 8px 10px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;

    /deep/ .dropdown-toggle {
      padding: 0;
      border: none;

      &::after {
        display: none;
      }

      .selected-tag, .form-control {
        margin: 0;
      }

      .vs__actions {
        align-items: center;

        .open-indicator {
          margin-top: -5px;
        }
      }
    }
}

.v-select.open .dropdown-toggle {
  border-color: #5cb3fd
}

.quill-editor {
  background-color: #fff;

  /deep/ .ql-toolbar {
    &.ql-snow {
      border-radius: 0.25rem 0.25rem 0 0;
    }
  }

  /deep/ .ql-container {
    &.ql-snow {
      border: none;
      margin-top: -1px;
    }

    .ql-editor {
      font-size: .9375rem;
      line-height: 1.5;
      display: block;
      width: 100%;
      min-height: 5.625rem;
      padding: .5rem .75rem;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
      color: #12263f;
      border: 1px solid #d2ddec;
      // border-radius: 0 0 0.25rem 0.25rem;
      background-color: #fff;
      background-clip: padding-box;

      &:focus {
        color: #12263f;
        border-color: #2c7be5;
        outline: 0;
        background-color: #fff;
        box-shadow: transparent;
      }
    }
  }
}
.custom-control-label {

  &::before, &::after {
    position: absolute;
    top: .20313rem;
    left: -1.5rem;
    display: block;
    width: 1rem;
    height: 1rem;
    content: "";
  }

  &::before {
    background-color: #e1e1e1;
    transition: background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }

}

.custom-checkbox-toggle {
  width: 3rem;
  height: 1.5rem;
  padding-left: 0;

  .custom-control-input:checked {
    &~.custom-control-label {
      &::before {
        color: #fff;
        background-color: #2c7be5;
      }

      &::after {
        right: 0;
        left: 1.5rem;
        background-color: #fff;
      }
    }
  }

  .custom-control-label {
    position: relative;
    width: 100%;
    height: 100%;

    &::after, &::before {
      position: absolute;
      top: 0;
      left: 0;
      content: "";
      transition: all .2s ease;
      border-radius: 1.5rem;
    }

    &::before {
      width: 100%;
      height: 100%;
    }

    &::after  {
      width: 1.5rem;
      height: 100%;
      transform: scale(.8);
      background-color: #fff;
    }
  }
}

.card {
  box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03);
  background-color: #edf2f9!important;
  border: 1px solid #e3ebf6!important;
}

.btn-toolbar {
  .btn {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
}
</style>
