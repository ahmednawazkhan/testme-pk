<template>
  <div class="a-subject">
    <b-button
      variant="link"
      type="button"
      v-b-toggle="`subject${subject.id}`"
    >
      <i class="fal fa-plus-circle" />
    </b-button>

    {{ subject.label }}

    <b-button variant="link" @click="editSubject">
      Edit
    </b-button>
    <b-button
      variant="link"
      @click="removeSubject()"
    >
      Delete
    </b-button>

    <b-collapse
      :id="`subject${subject.id}`"
    >
      <b-form
        @submit.prevent="addChapter()"
        class="subject-chapters"
      >
        <div class="form-group mb-0 ml-4 w-50">
          <input
            type="text"
            class="form-control"
            placeholder="Add chapter"
            v-model="newChapter"
          >
        </div>
      </b-form>
      <ul>
        <li
          v-for="chapter in subject.chapters"
          :key="chapter.id"
        >
          {{ chapter.label }}
        </li>
      </ul>
    </b-collapse>
  </div>
</template>

<script>
import Subject from '../../../models/subject'
import { createNamespacedHelpers } from 'vuex'

const { mapActions } = createNamespacedHelpers('mcq')

export default {
  name: 'ASubject',
  props: {
    subject: Subject
  },
  data () {
    return {
      newChapter: ''
    }
  },
  methods: {
    ...mapActions(['createChapter', 'deleteSubject']),
    addChapter () {
      const payload = { subject: this.subject.label, chapter: this.newChapter }

      this.createChapter(payload)
        .then((resp) => this.newChapter = '')

    },
    removeSubject () {
      const resp = confirm(
        `Do you confirm this action ?
         all chapters and questions related to this subject will be removed`
      )

      if (resp) {
        this.deleteSubject(this.subject)
      }
    },
    editSubject () {
      this.$emit('edit', this.subject)
    }
  }
}
</script>

<style lang="scss" scoped>
  .subject-chapters {
    .form-control {
      border: none;
      background-color: rgba(244, 244, 244, 0.3607843137254902);
      border-bottom: solid 1px #bbb5b582;
    }
  }
</style>
