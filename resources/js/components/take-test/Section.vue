<template>
  <div
    class="form-inline"
    v-if="currentSection"
  >
    <label
      class="mb-0"
      for="section"
    >
      <strong class="pr-1">
        Section {{ activeSection.index + 1 }} of
      </strong> {{ test.sections.length }}
    </label>
    <select
      v-model="activeSection"
      name="section"
      id="section"
      class="custom-select form-control-sm ml-2 mr-1 w-auto"
    >
      <option
        v-for="item in test.sections"
        :key="item.index"
        :value="item"
      >
        {{ item.name | capitalize }}
      </option>
    </select>
    <i
      class="far fa-question-circle"
      aria-hidden="true"
      v-b-tooltip.hover
      title="The list of sections of the current test.
            You can change sections and answer the questions in this section."
    />
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'

const { mapGetters, mapActions } = createNamespacedHelpers('takeTest')

export default {
  name: 'ASection',
  data () {
    return {
    }
  },
  computed: {
    ...mapGetters(['test', 'currentSection']),
    activeSection: {
      get () {
        return this.currentSection
      },
      set (section) {
        this.defineSection(section)
        this.defineQuestion(
          this.currentSection.questions[this.currentSection.currentQuestion]
        )
      }
    }
  },
  methods: {
    ...mapActions(['defineSection', 'defineQuestion'])
  },
  filters: {
    capitalize (value) {
      if (!value) return ''

      value = value.toString()
      return value.charAt(0).toUpperCase() + value.slice(1)
    }
  }
}
</script>
